document.addEventListener('DOMContentLoaded', function () {

    const btnProfile  = document.getElementById('btn-profile');
    const btnContacts = document.getElementById('btn-contacts');

    const profileBlock  = document.querySelector('.profile-info-wrapper');
    const contactsBlock = document.querySelector('.department-contacts');

    // защита от null
    if (!btnProfile || !btnContacts) {
        console.log('КНОПКИ НЕ НАЙДЕНЫ');
        return;
    }

    btnProfile.addEventListener('click', function () {
        profileBlock.style.display  = 'block';
        contactsBlock.style.display = 'none';
    });

    btnContacts.addEventListener('click', function () {
        profileBlock.style.display  = 'none';
        contactsBlock.style.display = 'block';
    });

});

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('changePasswordForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        btn.disabled = true;
        btn.innerText = 'Зміна пароля...';

        const formData = new FormData(form);

        fetch('{{ route('cabinet.profile.password.change') }}', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: formData
        })
    .then(res => res.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message || 'Помилка');
                    return;
                }

                alert(data.message);
                form.reset();
            })
            .catch(() => {
                alert('Помилка сервера');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerText = 'Змінити пароль';
            });
    });

});

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.toggle-password').forEach(toggle => {
        toggle.addEventListener('click', function () {

            const input = this.parentElement.querySelector('input');
            if (!input) return;

            input.type = input.type === 'password' ? 'text' : 'password';
        });
    });

});

document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('phoneInput');
    if (!input) return;

    input.addEventListener('input', function () {
        let x = input.value.replace(/\D/g, '').substring(0, 12);

        let formatted = '+38';

        if (x.length > 2) {
            formatted += '(' + x.substring(2, 5);
        }
        if (x.length >= 5) {
            formatted += ')';
        }
        if (x.length >= 6) {
            formatted += x.substring(5, 8);
        }
        if (x.length >= 8) {
            formatted += '-' + x.substring(8, 10);
        }
        if (x.length >= 10) {
            formatted += '-' + x.substring(10, 12);
        }

        input.value = formatted;
    });
});

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('personalInfoForm');
    if (!form) {
        console.warn('personalInfoForm not found');
        return;
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        if (!btn) {
            console.error('Submit button not found');
            return;
        }

        btn.disabled = true;
        btn.innerText = 'Збереження...';

        const formData = new FormData(form);

        try {
            const response = await fetch('/cabinet/profile/personal', {
                method: 'POST',
                credentials: 'same-origin', // 🔴 ОБЯЗАТЕЛЬНО
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            let data;
            try {
                data = await response.json();
            } catch (jsonError) {
                console.error('Response is not JSON', jsonError);
                throw jsonError;
            }

            // ❌ HTTP error (422 / 500 / 401)
            if (!response.ok) {
                console.error('SERVER ERROR:', {
                    status: response.status,
                    data: data
                });

                alert('Помилка сервера (дивись console)');
                return;
            }

            // ❌ Логическая ошибка
            if (!data.success) {
                console.error('APP ERROR:', data);
                alert('Помилка збереження');
                return;
            }

            // ✅ Успех
            console.log('SUCCESS:', data);
            alert(data.message);

        } catch (err) {
            console.error('FETCH FAILED:', err);
            alert('Помилка сервера (дивись console)');
        } finally {
            btn.disabled = false;
            btn.innerText = 'Зберегти дані';
        }
    });

});
