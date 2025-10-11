
document.addEventListener('DOMContentLoaded', function () {

    // ✅ زر "رد" لإظهار/إخفاء نموذج الرد
    document.querySelectorAll('.reply-toggle').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.getAttribute('data-comment-id');
            const form = document.getElementById('reply-form-' + commentId);
            if (!form) return;

            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
                const textarea = form.querySelector('textarea');
                if (textarea) textarea.focus();
            } else {
                form.style.display = 'none';
            }
        });
    });

    // ✅ زر "عرض المزيد من الردود"
    document.querySelectorAll('.toggle-replies').forEach(button => {
        button.addEventListener('click', () => {
            const commentId = button.dataset.commentId;
            const repliesDiv = document.getElementById(`replies-${commentId}`);
            if (!repliesDiv) return;

            if (repliesDiv.style.display === 'none' || repliesDiv.style.display === '') {
                repliesDiv.style.display = 'block';
                button.textContent = 'إخفاء الردود';
            } else {
                repliesDiv.style.display = 'none';
                button.textContent = `عرض ${repliesDiv.children.length} رد`;
            }
        });
    });

    // ✅ تفاعل زر الإعجاب الأساسي للتعليقات والردود
    document.querySelectorAll('.main-reaction').forEach(button => {
        button.addEventListener('click', function () {
            const commentId = this.dataset.commentId;
            const currentReaction = this.dataset.currentReaction;
            if (currentReaction) {
                sendCommentReaction(commentId, currentReaction);
            } else {
                sendCommentReaction(commentId, 'like');
            }
        });
    });

    // ✅ عند الضغط على أيقونة من قائمة التفاعل (❤️، 😡، 😂، 😢)
    document.querySelectorAll('.reaction-icon').forEach(icon => {
        icon.addEventListener('click', function () {
            const commentId = this.dataset.commentId;
            const type = this.dataset.reactionType;
            sendCommentReaction(commentId, type);
        });
    });

    // ✅ فتح قائمة التفاعلات عند الضغط على الزر الأساسي
    document.querySelectorAll('.comment-reaction-btn').forEach(container => {
        const mainBtn = container.querySelector('.main-reaction');
        const menu = container.querySelector('.reaction-menu');

        mainBtn.addEventListener('click', e => {
            e.stopPropagation();
            menu.style.display = (menu.style.display === 'flex') ? 'none' : 'flex';
        });

        menu.querySelectorAll('.reaction-icon').forEach(icon => {
            icon.addEventListener('click', () => {
                const commentId = icon.dataset.commentId;
                const type = icon.dataset.reactionType;
                sendCommentReaction(commentId, type, () => {
                    menu.style.display = 'none';
                });
            });
        });
    });

    // ✅ إغلاق كل قوائم التفاعل عند الضغط خارجها
    document.addEventListener('click', () => {
        document.querySelectorAll('.reaction-menu').forEach(menu => {
            menu.style.display = 'none';
        });
    });

}); // نهاية DOMContentLoaded

// ✅ إرسال التفاعل عبر fetch
function sendCommentReaction(commentId, type, callback = null) {
    fetch(`/comments/${commentId}/react`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ type: type })
    })
    .then(response => {
        if (!response.ok) throw new Error('Network error');
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            updateCommentReactionUI(commentId, data.reaction);
            if (callback) callback();
        } else {
            alert(data.message || 'حدث خطأ في التفاعل');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('فشل الاتصال بالخادم');
    });
}

// ✅ تحديث واجهة زر التفاعل
function updateCommentReactionUI(commentId, reaction) {
    const btn = document.getElementById(`mainReactionComment-${commentId}`);
    const labels = {
        'like': '👍 أعجبني',
        'love': '❤️ معجب',
        'haha': '😂 ضاحك',
        'sad': '😢 حزين',
        'angry': '😡 غاضب'
    };

    if (reaction) {
        btn.textContent = labels[reaction.type];
        btn.classList.add('reaction-active');
        btn.dataset.currentReaction = reaction.type;
    } else {
        btn.textContent = '👍 أعجبني';
        btn.classList.remove('reaction-active');
        btn.dataset.currentReaction = '';
    }
}

