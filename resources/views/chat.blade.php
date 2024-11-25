<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chat Room') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-10">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="p-4 border-b bg-gray-100 dark:bg-gray-900">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Chat Room</h1>
            </div>
            <div id="chat-messages" class="p-4 h-96 overflow-y-auto bg-gray-50 dark:bg-gray-800" style="max-height: 300px;">
                <!-- Messages will appear here -->
                @foreach ($messages->take(5) as $message)
                    <div class="mb-3">
                        <strong class="text-gray-800 dark:text-gray-200">{{ $message->user->name }}:</strong>
                        <p class="text-gray-800 dark:text-gray-200">{{ $message->content }}</p>
                        <small class="text-gray-500">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
                <div id="load-more-messages" class="text-gray-800 dark:text-gray-200">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="loadMoreMessages()">Load More</button>
                </div>
            </div>
            <div class="p-4 border-t bg-gray-100 dark:bg-gray-900">
                <form id="sendMessageForm" method="POST" action="{{ route('chat.send') }}">
                    @csrf
                    <div class="flex items-center">
                        <input type="text" name="content" id="message" placeholder="Type a message"
                               class="w-full border rounded px-4 py-2 mr-2 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200" required>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Scroll to the bottom of the chat messages
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Load more messages
        function loadMoreMessages() {
            const loadMoreButton = document.getElementById('load-more-messages');
            const chatMessagesContainer = document.getElementById('chat-messages');
            const currentMessages = chatMessagesContainer.children.length;
            const messagesToLoad = 5;

            // Make an AJAX request to load more messages
            $.ajax({
                type: 'GET',
                url: '/messages',
                data: {
                    offset: currentMessages,
                    limit: messagesToLoad
                },
                success: function(response) {
                    const newMessages = response.messages;
                    newMessages.forEach(function(message) {
                        const messageHTML = `
                            <div class="mb-3">
                                <strong class="text-gray-800 dark:text-gray-200">${message.user.name}:</strong>
                                <p class="text-gray-800 dark:text-gray-200">${message.content}</p>
                                <small class="text-gray-500">${message.created_at.diffForHumans()}</small>
                            </div>
                        `;
                        chatMessagesContainer.innerHTML += messageHTML;
                    });

                    // Update the scroll position
                    chatMessages.scrollTop = chatMessages.scrollHeight;

                    // Remove the load more button if there are no more messages
                    if (newMessages.length < messagesToLoad) {
                        loadMoreButton.remove();
                    }
                }
            });
        }
    </script>
</x-app-layout>
