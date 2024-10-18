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
            background-color: var(--accent-color);
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
        }

        .btn:hover {
            background-color: var(--accent-hover);
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
            flex-direction: column;
            align-items: flex-start;
        }

        header .container > div form {
            margin-top: 10px;
            width: 100%;
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
<body>
    <header>
        <div class="container">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center;">
                <h1>MediaChat</h1>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </header>

    <div class="container">
        <button class="btn" onclick="toggleForm()"><i class="fas fa-plus"></i> New Post</button>
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
                    <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Post</button>
                </div>
            </form>
        </div>

        <div class="content">
            <div class="widget">
                <h2><i class="fas fa-comments"></i> Recent Posts</h2>
                <div class="chat-list">
                    @php
                        $chats = App\Models\Chat::orderBy('tanggal', 'desc')->get();
                    @endphp
                    @if($chats->count() > 0)
                        @foreach($chats as $chat)
                            <div class="chat-item">
                                <h3>{{ $chat->judul }}</h3>
                                <p>{{ $chat->isi }}</p>
                                <p class="meta">
                                    <i class="far fa-clock"></i> Posted on: {{ $chat->tanggal->format('M d, Y') }}
                                </p>
                                <p class="meta">
                                    <i class="fas fa-user-tag"></i> Mentioned: {{ $chat->sebut }}
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

    <!--<footer>-->
    <!--    <div class="container">-->
    <!--        <p>&copy; 2024 Universitas Binaniaga Indonesia</p>-->
    <!--    </div>-->
    <!--</footer>-->

    <script>
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
