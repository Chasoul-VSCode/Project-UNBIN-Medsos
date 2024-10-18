<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

@php
    $loggedInUser = Auth::user()->username; // Get the username of the logged-in user
@endphp

<body>
    <header>
        <div class="container">
            <div>
                <div class="logo-container">
                    <img src="{{ asset('images/logo unbin.png') }}" alt="MediaChat Logo" class="logo-image">
                    <span class="logo-text">BMS</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="logout-form" style="width: auto;">
                    @csrf
                    <button type="submit" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <div style="display: flex; align-items: center; margin-bottom: 15px;">
            <button class="btn btn-new-post" onclick="toggleForm()">
                <i class="fas fa-plus"></i> New Post
            </button>
            @php
                $activeUsers = App\Models\User::where('status', 1)->count();
            @endphp
            <div class="active-users">
                <i class="fas fa-users"></i> Active Users: {{ $activeUsers }}
            </div>
        </div>

        <div class="post-form" id="postForm" style="display: none;">
            <h2>Create a New Post</h2>
            <form method="POST" action="{{ route('chats.store') }}">
                @csrf
                <input type="text" name="judul" placeholder="Post Title" required>
                <textarea name="isi" placeholder="Post Content" rows="4" required></textarea>
                <div class="mention-input-container">
                    <input type="text" id="mentionInput" placeholder="Mention a user" autocomplete="off">
                    <input type="hidden" name="sebut" id="selectedMention">
                    <div id="mentionSuggestions" class="mention-suggestions"></div>
                </div>
                <div>
                    <button type="submit" class="btn btn-new-post"><i class="fas fa-paper-plane"></i> Post</button>
                </div>
            </form>
        </div>

        <div class="content">
            <div class="widget">
                <h2><i class="fas fa-comments"></i> Recent Posts</h2>
                <div class="chat-list" id="chatList">
                    @php
                        $chats = App\Models\Chat::orderBy('tanggal', 'desc')->get();
                    @endphp
                    @if($chats->count() > 0)
                        @foreach($chats as $chat)
                        <div class="chat-item" data-mention="{{ $chat->sebut }}">
                            <h3>{{ $chat->judul }}</h3>
                            <p>{{ $chat->isi }}</p>
                            <p class="meta">
                                <i class="far fa-clock"></i> Posted on: {{ $chat->tanggal->format('M d, Y H:i') }}
                            </p>
                            <p class="meta">
                                <i class="fas fa-user-tag"></i> Mentioned: 
                                @if($chat->sebut === 'Everyone')
                                    <strong>@everyone</strong>
                                @else
                                    {{ $chat->sebut }}
                                @endif
                            </p>
                        </div>
                        @endforeach
                    @else
                        <p>No recent posts available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <button id="notificationButton" class="notification-button"><i class="fas fa-bell"></i></button>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loggedInUser = @json($loggedInUser); // Get the logged-in user's username
            const notificationButton = document.getElementById('notificationButton');
            const chatList = document.getElementById('chatList');
            let showingMentions = false; // Track whether we're showing mentions or not

            notificationButton.addEventListener('click', function() {
                const chatItems = chatList.getElementsByClassName('chat-item');

                if (!showingMentions) {
                    // Filter to show only the chats where the user is mentioned
                    for (let chatItem of chatItems) {
                        const mention = chatItem.getAttribute('data-mention');
                        if (mention !== loggedInUser && mention !== 'Everyone') {
                            chatItem.style.display = 'none'; // Hide chat items where user is not mentioned
                        } else {
                            chatItem.style.display = 'block'; // Show chat items where user is mentioned
                        }
                    }
                    showingMentions = true; // Update the toggle state
                } else {
                    // Reset to show all chats
                    for (let chatItem of chatItems) {
                        chatItem.style.display = 'block';
                    }
                    showingMentions = false; // Update the toggle state
                }
            });
        });
            function toggleForm() {
            var form = document.getElementById("postForm");
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const mentionInput = document.getElementById('mentionInput');
            const selectedMention = document.getElementById('selectedMention');
            const mentionSuggestions = document.getElementById('mentionSuggestions');
            const users = @json(App\Models\User::pluck('username'));

             users.push('@everyone');

            mentionInput.addEventListener('input', function() {
                const inputValue = this.value.toLowerCase();
                const filteredUsers = users.filter(user => user.toLowerCase().includes(inputValue));
                
                mentionSuggestions.innerHTML = '';
                filteredUsers.forEach(user => {
                    const div = document.createElement('div');
                    div.textContent = user;
                    div.addEventListener('click', function() {
                        mentionInput.value = user;
                        selectedMention.value = user;
                        mentionSuggestions.innerHTML = '';
                    });
                    mentionSuggestions.appendChild(div);
                });
            });

            document.addEventListener('click', function(e) {
                if (e.target !== mentionInput && e.target !== mentionSuggestions) {
                    mentionSuggestions.innerHTML = '';
                }
            });
             });
    </script>

</body>
</html>
