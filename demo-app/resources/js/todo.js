document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.toggle-complete');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', async (event) => {
            event.preventDefault();
            
            // data-todo-id からIDを取得
            const todoId = event.target.dataset.todoId; 
            
            // metaタグからCSRFトークンを取得
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            try {
                // URLの組み立て (※注意点あり。後述)
                const response = await fetch(`/todos/${todoId}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                });
                
                if (!response.ok) {
                    throw new Error('サーバーエラーが発生しました');
                }
                
                const data = await response.json();
                
                // 見た目の更新
                const listItem = event.target.closest('li');
                if (data.is_completed) {
                    listItem.classList.add('completed-task');
                } else {
                    listItem.classList.remove('completed-task');
                }
                
            } catch (error) {
                console.error('エラー:', error);
                event.target.checked = !event.target.checked; 
            }
        });
    });
});