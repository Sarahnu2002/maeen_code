@extends('admin.main')
@push('css')
    <style>
        /* Chat Popup Container */
        #chatPopup {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 350px;
            max-width: 90%;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            z-index: 10000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            font-family: 'Cairo', sans-serif;
        }

        /* Chat Popup Header */
        #chatPopup .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            margin-bottom: 10px;
        }
        #chatPopup .chat-header h5 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        #chatPopup .close-btn {
            background: transparent;
            border: none;
            font-size: 20px;
            color: #666;
            cursor: pointer;
        }

        /* Chat Messages Area */
        #chatMessages {
            max-height: 250px;
            overflow-y: auto;
            padding: 10px;
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        /* Chat Message Bubble Styles */
        .chat-message {
            display: flex;
            margin-bottom: 10px;
            align-items: flex-end;
        }

        .chat-message.received {
            justify-content: flex-start;
        }

        .chat-message.sent {
            justify-content: flex-end;
        }

        .chat-message .user-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ccc;
            flex-shrink: 0;
            /* padding: 10px; */
            text-align: center;
            color: #499d67;
        }

        .chat-message.received .user-icon {
            margin-right: 8px;
        }

        .chat-message.sent .user-icon {
            margin-right: 8px;
        }

        /* Message bubble container */
        .chat-message .message-bubble {
            max-width: 70%;
            padding: 8px 12px;
            border-radius: 15px;
            font-size: 14px;
            line-height: 1.4;
            position: relative;
        }

        /* Received message bubble (from partner) */
        .chat-message.received .message-bubble {
            background: #F1F0F0;
            color: #333;
            border-bottom-left-radius: 0;
        }

        /* Sent message bubble (logged-in user) */
        .chat-message.sent .message-bubble {
            background: #DCF8C6;
            color: #333;
            border-bottom-right-radius: 0;
        }

        /* Chat Form (textarea and button) */
        #chatPopup textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 8px;
            font-size: 14px;
            resize: none;
        }

        #chatPopup button {
            border-radius: 4px;
        }

    </style>
@endpush
@php
    $user = auth()->user();
    $myUserId = $user->user_id;
    if ($user->doctor) {
        $role = 'doctor';
    } elseif ($user->patient) {
        $role = 'patient';
    } elseif ($user->pharmacist) {
        $role = 'pharmacist';
    } else {
        $role = 'admin';
    }
    $uniqueConversations = [];
    foreach ($chats as $chatItem) {
        $partnerId = ($chatItem->sender_id == $myUserId)
            ? $chatItem->receiver_id
            : $chatItem->sender_id;
        if (!isset($uniqueConversations[$partnerId])) {
            $uniqueConversations[$partnerId] = $chatItem;
        }
    }
@endphp

@section('content')
    <main class="app-content">
        <div class="app-title">
            <h1>
                <i class="fa fa-comments"></i> {{ __('الاستشارات') }}
            </h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <div class="d-flex mainAdd">
                        <h3 class="tile-title">{{ __('المحادثات') }}</h3>
                        <!-- Button to trigger "Start New Chat" popup -->
                        <button type="button" class="btn btn-primary ml-auto" onclick="toggleNewChatPopup()">
                            <i class="fa fa-plus"></i> {{ __('بدء محادثة جديدة') }}
                        </button>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success mt-2">{{ session('success') }}</div>
                    @endif
                    @if($errors->has('error'))
                        <div class="alert alert-danger mt-2">{{ $errors->first('error') }}</div>
                    @endif

                    <table class="table table-striped" id="sampleTable">
                        <thead>
                        <tr>
                            <th>{{ __('المرسل') }}</th>
                            <th>{{ __('آخر رسالة') }}</th>
                            <th>{{ __('التاريخ والوقت') }}</th>
                            <th>{{ __('الإجراءات') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($uniqueConversations as $partnerId => $lastChat)
                            @php
                                $partner = ($lastChat->sender_id == $myUserId)
                                    ? $lastChat->receiver
                                    : $lastChat->sender;
                            @endphp
                            <tr>
                                <td>
                                    @if($partner)
                                        {{ $partner->first_name }} {{ $partner->last_name }}

                                    @else
                                        <span class="text-muted">{{ __('غير معروف') }}</span>
                                    @endif
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($lastChat->message, 50) }}</td>
                                <td>{{ $lastChat->dateTime }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                            onclick="openChatWith({{ $partnerId }}, '{{ $partner ? $partner->first_name . ' ' . $partner->last_name : 'غير معروف' }}')">
                                        {{ __('فتح المحادثة') }} <i class="fa fa-comment-o"></i>
                                    </button>
                                    @if($partner->patient)
                                        <button class="btn btn-sm btn-info ml-2" data-toggle="modal" data-target="#patientModal{{ $partner->user_id }}">
                                            📄 {{ __('سجل المريض') }}
                                        </button>
                                    @endif
                                    @if($partner && $partner->patient)
                                        <!-- مودال تفاصيل المريض -->
                                        <div class="modal fade" id="patientModal{{ $partner->user_id }}" tabindex="-1" role="dialog" aria-labelledby="patientModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title"><i class="fa fa-user-md"></i> {{ __('معلومات المريض') }}</h5>
                                                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <!-- معلومات المريض -->
                                                            <div class="col-md-12">
                                                                <h4 class="text-primary">{{ $partner->first_name }} {{ $partner->last_name }}</h4>
                                                                <p><strong><i class="fa fa-envelope"></i> {{ __('البريد الإلكتروني:') }}</strong> {{ $partner->email }}</p>
                                                                <p><strong><i class="fa fa-phone"></i> {{ __('رقم الجوال:') }}</strong> {{ $partner->phone }}</p>
                                                                <p><strong><i class="fa fa-map-marker"></i> {{ __('العنوان:') }}</strong> {{ $partner->patient->address }}</p>
                                                                <p><strong><i class="fa fa-calendar"></i> {{ __('تاريخ الميلاد:') }}</strong> {{ $partner->patient->date_of_birth }}</p>
                                                                <p><strong><i class="fa fa-medkit"></i> {{ __('التأمين الصحي:') }}</strong> {{ $partner->patient->insurance_info }}</p>
                                                                <p><strong><i class="fa fa-exclamation-triangle"></i> {{ __('الحساسية:') }}</strong> {{ $partner->patient->allergies }}</p>
                                                                <p><strong><i class="fa fa-user-shield"></i> {{ __('جهة الاتصال في حالة الطوارئ:') }}</strong> {{ $partner->patient->emergency_contact }}</p>
                                                            </div>
                                                        </div>

                                                        <hr>

                                                        <!-- جدول الوصفات الطبية -->
                                                        <h5 class="text-primary mt-4"><i class="fa fa-file-medical"></i> {{ __('الوصفات الطبية') }}</h5>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered">
                                                                <thead class="bg-primary text-white">
                                                                <tr>
                                                                    <th>{{ __('التاريخ') }}</th>
                                                                    <th>{{ __('الطبيب المعالج') }}</th>
                                                                    <th>{{ __('التعليمات') }}</th>
                                                                    <th>{{ __('الجرعة') }}</th>
                                                                    <th>{{ __('المتبقي من التجديد') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($partner->patient->prescriptions as $prescription)
                                                                    <tr>
                                                                        <td>{{ $prescription->date_issued }}</td>
                                                                        <td>{{ $prescription->doctor->user->first_name }} {{ $prescription->doctor->user->last_name }}</td>
                                                                        <td>{{ $prescription->instructions }}</td>
                                                                        <td>{{ $prescription->dosage }}</td>
                                                                        <td>{{ $prescription->refills_remaining }}</td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> {{ __('إغلاق') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </td>
                            </tr>


                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">{{ __('لا توجد محادثات') }}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div id="newChatPopup" style="display:none; position: fixed; top: 100px; left: 40%; width: 320px; background: #fff; border: 1px solid #ccc; padding: 15px; z-index:10000; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
        <h5>{{ __('بدء محادثة جديدة') }}</h5>
        <div class="form-group">
            <label>{{ __('نوع المستخدم') }}:</label>
            <select id="newChatUserType" class="form-control">
                <option value="">{{ __('-- اختر --') }}</option>
                @if($role === 'patient')
                    <option value="doctor">{{ __('طبيب') }}</option>
                    <option value="pharmacist">{{ __('صيدلي') }}</option>
                @elseif($role === 'doctor')
                    <option value="patient">{{ __('مريض') }}</option>
                    <option value="pharmacist">{{ __('صيدلي') }}</option>
                @elseif($role === 'pharmacist')
                    <option value="doctor">{{ __('طبيب') }}</option>
                    <option value="patient">{{ __('مريض') }}</option>
                @else
                    <option value="doctor">{{ __('طبيب') }}</option>
                    <option value="patient">{{ __('مريض') }}</option>
                    <option value="pharmacist">{{ __('صيدلي') }}</option>
                @endif
            </select>
        </div>
        <div class="form-group">
            <label>{{ __('اختر المستخدم') }}:</label>
            <select id="newChatUser" class="form-control">
                <option value="">{{ __('-- اختر --') }}</option>
                {{-- This select will be populated via AJAX based on the selected type --}}
            </select>
        </div>
        <button class="btn btn-success" onclick="startChatWithSelectedUser()">
            {{ __('بدء المحادثة') }}
        </button>
        <button class="btn btn-secondary" onclick="toggleNewChatPopup()">
            {{ __('إغلاق') }}
        </button>
    </div>

    <div id="chatPopup">
        <div class="chat-header">
            <h5 id="chatPartnerName">محادثة مع #...</h5>
            <button class="close-btn" onclick="toggleChatPopup()"><i class="fa fa-times text-danger"></i></button>
        </div>
        <div id="chatMessages">
            <!-- Example message: received -->
            <div class="chat-message received">
                <div class="user-icon">
                    <i class="fa fa-user"></i>
                </div>
                <div class="message-bubble">
                    مرحباً، كيف يمكنني مساعدتك؟
                </div>
            </div>
            <!-- Example message: sent -->
            <div class="chat-message sent">
                <div class="message-bubble">
                    أحتاج إلى استشارة بشأن دواء معين.
                </div>
                <div class="user-icon">
                    <i class="fa fa-user"></i>
                </div>
            </div>
        </div>
        <form id="chatForm" onsubmit="sendChatMessage(); return false;">
            <textarea id="chatMessageInput" rows="2" placeholder="أدخل رسالتك هنا..."></textarea>
            <button type="submit" class="btn btn-primary btn-sm mt-2">إرسال</button>
        </form>
    </div>



@endsection

@push('js')
    <script>
        function toggleNewChatPopup() {
            const newChatDiv = document.getElementById('newChatPopup');
            newChatDiv.style.display = (newChatDiv.style.display === 'none') ? 'block' : 'none';
        }
        const myUserId = {{ $myUserId }};
        function toggleChatPopup() {
            const chatDiv = document.getElementById('chatPopup');
            chatDiv.style.display = (chatDiv.style.display === 'none' || chatDiv.style.display === '') ? 'block' : 'none';
        }
        function openChatWith(partnerId, partnerName) {
            toggleChatPopup();
            document.getElementById('chatPartnerName').innerText = '{{ __("محادثة مع") }} ' + partnerName;
            window.currentChatPartnerId = partnerId;
            loadChatHistory(partnerId);
        }
        function loadChatHistory(partnerId) {
            fetch('{{ route("chat.getHistory") }}?partner_id=' + partnerId)
                .then(response => response.json())
                .then(messages => {
                    const chatBox = document.getElementById('chatMessages');
                    chatBox.innerHTML = '';
                    messages.forEach(msg => {
                        const msgDiv = document.createElement('div');
                        // Determine if message is sent (by logged in user) or received.
                        const isSent = (msg.sender_id == myUserId);
                        msgDiv.className = 'chat-message ' + (isSent ? 'sent' : 'received');

                        // Create the user icon element
                        const icon = document.createElement('div');
                        icon.className = 'user-icon';
                        icon.innerHTML = '<i class="fa fa-user"></i>';

                        // Create the message bubble element
                        const bubble = document.createElement('div');
                        bubble.className = 'message-bubble';
                        bubble.textContent = msg.message;

                        // Append children based on message type
                        if (!isSent) {
                            // Received messages: icon on left, bubble on right
                            msgDiv.appendChild(icon);
                            msgDiv.appendChild(bubble);
                        } else {
                            // Sent messages: bubble on right, icon on right
                            msgDiv.appendChild(bubble);
                            msgDiv.appendChild(icon);
                        }

                        chatBox.appendChild(msgDiv);
                    });
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(error => {
                    console.error('Error loading chat history:', error);
                });
        }

        // Send chat message using AJAX POST to ChatController@store
        function sendChatMessage() {
            const msgInput = document.getElementById('chatMessageInput');
            const msg = msgInput.value.trim();
            if (!msg) return;

            const data = {
                receiver_id: window.currentChatPartnerId,
                message: msg
            };

            fetch('{{ route("chat.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(result => {
                    // On success, append the new message to the chat window
                    const chatBox = document.getElementById('chatMessages');
                    const msgDiv = document.createElement('div');
                    msgDiv.className = 'chat-message sent';

                    const bubble = document.createElement('div');
                    bubble.className = 'message-bubble';
                    bubble.textContent = "أنا: " + msg;

                    const icon = document.createElement('div');
                    icon.className = 'user-icon';
                    icon.innerHTML = '<i class="fa fa-user"></i>';

                    msgDiv.appendChild(bubble);
                    msgDiv.appendChild(icon);

                    chatBox.appendChild(msgDiv);
                    msgInput.value = '';
                    chatBox.scrollTop = chatBox.scrollHeight;
                })
                .catch(error => {
                    console.error('Error sending message:', error);
                    alert('{{ __("حدث خطأ أثناء إرسال الرسالة") }}');
                });
        }


        // When the user selects a type, load users via AJAX
        document.getElementById('newChatUserType').addEventListener('change', function() {
            const type = this.value;
            const newChatUserSelect = document.getElementById('newChatUser');
            newChatUserSelect.innerHTML = '<option value="">{{ __("تحميل...") }}</option>';
            if (!type) {
                newChatUserSelect.innerHTML = '<option value="">{{ __("-- اختر --") }}</option>';
                return;
            }
            // AJAX call to fetch users based on type.
            fetch('{{ route("chat.getUsers") }}?type=' + type)
                .then(response => response.json())
                .then(data => {
                    let options = '<option value="">{{ __("-- اختر --") }}</option>';
                    data.forEach(user => {
                        options += `<option value="${user.user_id}">${user.first_name} ${user.last_name} (ID: ${user.user_id})</option>`;
                    });
                    newChatUserSelect.innerHTML = options;
                })
                .catch(err => {
                    console.error(err);
                    newChatUserSelect.innerHTML = '<option value="">{{ __("خطأ في تحميل المستخدمين") }}</option>';
                });
        });


        function startChatWithSelectedUser() {
            const userType = document.getElementById('newChatUserType').value;
            const userId = document.getElementById('newChatUser').value;
            if (!userType || !userId) {
                alert('{{ __("الرجاء اختيار نوع المستخدم والمستخدم المطلوب") }}');
                return;
            }
            // Open chat with selected user
            openChatWith(userId, 'User #' + userId);
            toggleNewChatPopup();
        }
    </script>
@endpush

