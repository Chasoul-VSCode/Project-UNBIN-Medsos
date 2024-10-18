<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #121212;
            --bg-secondary: #1e1e1e;
            --bg-tertiary: #2c2c2c;
            --text-primary: #ffffff;
            --text-secondary: #b3b3b3;
            --accent-color: #3498db;
            --accent-hover: #2980b9;
            --border-color: #333333;
            --logout-color: #e74c3c;
            --logout-hover: #c0392b;
            --new-post-color: #2ecc71;
            --new-post-hover: #27ae60;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            font-size: 16px;
        }

        .container {
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
            padding: 15px;
            box-sizing: border-box;
        }

        header {
            background-color: var(--bg-secondary);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h1, h2, h3 {
            font-weight: 600;
            margin-top: 0;
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 1.3rem;
        }

        h3 {
            font-size: 1.1rem;
        }

        .content {
            background-color: var(--bg-secondary);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            padding: 15px;
            margin-top: 15px;
        }

        .widget {
            background-color: var(--bg-tertiary);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .widget:hover {
            transform: translateY(-3px);
        }

        .post-form {
            background-color: var(--bg-tertiary);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .post-form input, .post-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            border-radius: 4px;
            transition: border-color 0.3s ease;
            box-sizing: border-box;
        }

        .post-form input:focus, .post-form textarea:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .btn {
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            width: 100%;
            margin-bottom: 10px;
            display: inline-block;
            text-align: center;
        }

        .btn-logout {
            background-color: var(--logout-color);
            float: right;
            margin-left: 10px;
        }

        .btn-logout:hover {
            background-color: var(--logout-hover);
        }

        .btn-new-post {
            background-color: var(--new-post-color);
        }

        .btn-new-post:hover {
            background-color: var(--new-post-hover);
        }

        .chat-item {
            background-color: var(--bg-tertiary);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .chat-item:hover {
            transform: translateY(-3px);
        }

        .chat-item h3 {
            margin-bottom: 10px;
            color: var(--text-primary);
        }

        .chat-item p {
            margin: 10px 0;
            color: var(--text-secondary);
        }

        .chat-item .meta {
            font-size: 0.8rem;
            color: var(--text-secondary);
            margin: 5px 0;
        }

        .mention-input-container {
            position: relative;
        }

        .mention-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 4px;
            max-height: 150px;
            overflow-y: auto;
            z-index: 1000;
        }

        .mention-suggestions div {
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .mention-suggestions div:hover {
            background-color: var(--bg-tertiary);
        }

        header .container > div {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header .container > div form {
            margin-top: 10px;
            width: 100%;
        }

        .active-users {
            background-color: var(--bg-tertiary);
            border-radius: 8px;
            padding: 10px 15px;
            margin-bottom: 15px;
            font-weight: 500;
            color: var(--accent-color);
            text-align: center;
            width: 100%;
        }

                .notification-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: var(--accent-color);
            color: white;
            border: none;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        .notification-button:hover {
            background-color: var(--accent-hover);
            transform: scale(1.1);
        }

        @media (min-width: 768px) {
            .container {
                max-width: 750px;
            }

            .btn {
                width: auto;
            }

            header .container > div {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            header .container > div form {
                margin-top: 0;
                width: auto;
            }

            .active-users {
                width: auto;
                margin-bottom: 0;
                margin-right: 15px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 970px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1170px;
            }
        }
    </style>
</head>

@php
    $loggedInUser = Auth::user()->username; // Get the username of the logged-in user
@endphp

<body>
    <header>
        <div class="container">
            <div>
                <h1>MediaChat</h1>
                <div style="display: flex; flex-direction: column; align-items: center; width: 100%;">
                    @php
                        $activeUsers = App\Models\User::where('status', 1)->count();
                    @endphp
                    <div class="active-users">
                        <i class="fas fa-users"></i> Active Users: {{ $activeUsers }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form" style="width: 100%;">
                        @csrf
                        <button type="submit" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

      <div class="container">
        <button class="btn btn-new-post" onclick="toggleForm()" style="margin-bottom: 15px;">
            <i class="fas fa-plus"></i> New Post
        </button>

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
