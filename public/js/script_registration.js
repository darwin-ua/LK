/* script_registration.js

 */

(() => {
  // ====== ЕЛЕМЕНТИ ======
  const root = document;
  const rightCol = root.querySelector('.right-column');
  const slider = root.querySelector('.slider');
  const dotsWrap = root.querySelector('.slider-dots');
  const dots = dotsWrap ? Array.from(dotsWrap.querySelectorAll('.dot')) : [];

  // Слайды:
  const slideBasic = Array.from(root.querySelectorAll('.slide.one, .slide.two, .slide.three')); // автокарусель
  const slideVerify = root.querySelector('.slide.Verify-Email');
  const slideNewPass = root.querySelector('.slide.New-Password');
  const slideSuccess = root.querySelector('.slide.Successfully-changed');

  // Формы / екраны:
  const boxSignIn = root.querySelector('.form-box.Sign-in');
  const boxVerify = root.querySelector('.form-box.Verify-Email');
  const boxNewPass = root.querySelector('.form-box.New-Password');
  const boxSuccess = root.querySelector('.form-box.Successfully-changed');

  const formBoxes = [boxSignIn, boxVerify, boxNewPass, boxSuccess].filter(Boolean);

  // ====== УТИЛИТЫ ПЕРЕМЕЩЕНИЯ БЛОКОВ ======
  function showOnly(el) {
    formBoxes.forEach(b => b && (b.style.display = b === el ? '' : 'none'));
  }

  function showOnlySlide(slide) {
    // Скрываем все слайды
    const allSlides = Array.from(root.querySelectorAll('.slide'));
    allSlides.forEach(s => (s.style.display = 'none'));

    // Показываем нужный
    if (slide) slide.style.display = '';

    // Крапки показываем только для базовой тройки
    const isBasic = slideBasic.includes(slide);
    if (dotsWrap) dotsWrap.style.display = isBasic ? '' : 'none';
  }

  // ====== СТАН/РОУТ ======
  // Допоможінний стан: "режим" слайдера (basic vs static)
  let sliderMode = 'basic'; // 'basic' | 'static'
  function setMode(mode) {
    sliderMode = mode;
    if (mode === 'basic') {
      // показати карусельну тройку, активувати автоплей
      stopAutoplay();
      current = 0;
      updateBasicSlides();
      startAutoplay();
    } else {
      // статичний слайд під конкретний екран, без автоплея
      stopAutoplay();
    }
  }

  // ====== СЛАЙДЕР (для перших 3 слайдов) ======
  let current = 0;
  let timer = null;
  const AUTOPLAY_MS = 5000;

  function updateBasicSlides() {
    slideBasic.forEach((s, i) => (s.style.display = i === current ? '' : 'none'));
    if (dots.length) {
      dots.forEach((d, i) => d.classList.toggle('active', i === current));
    }

    [slideVerify, slideNewPass, slideSuccess].forEach(s => s && (s.style.display = 'none'));

    if (dotsWrap) dotsWrap.style.display = '';
  }

  function nextSlide() {
    current = (current + 1) % slideBasic.length;
    updateBasicSlides();
  }

  function goToSlide(idx) {
    current = idx % slideBasic.length;
    updateBasicSlides();
  }

  function startAutoplay() {
    stopAutoplay();
    timer = setInterval(() => {
      if (sliderMode === 'basic') nextSlide();
    }, AUTOPLAY_MS);
  }

  function stopAutoplay() {
    if (timer) {
      clearInterval(timer);
      timer = null;
    }
  }

  // Навигация крапками
  if (dots.length) {
    dots.forEach((dot, i) => {
      dot.addEventListener('click', () => {
        if (sliderMode !== 'basic') return;
        goToSlide(i);
      });
    });
  }

  // Пауза на наведении
  if (rightCol) {
    rightCol.addEventListener('mouseenter', stopAutoplay);
    rightCol.addEventListener('mouseleave', () => sliderMode === 'basic' && startAutoplay());
  }

  // Swipe (тач)
  let touchStartX = null;
  function onTouchStart(e) {
    if (e.touches && e.touches.length) touchStartX = e.touches[0].clientX;
  }
  function onTouchEnd(e) {
    if (touchStartX == null || sliderMode !== 'basic') return;
    const endX = (e.changedTouches && e.changedTouches[0].clientX) || touchStartX;
    const dx = endX - touchStartX;
    if (Math.abs(dx) > 40) {
      if (dx < 0) nextSlide();
      else {
        current = (current - 1 + slideBasic.length) % slideBasic.length;
        updateBasicSlides();
      }
    }
    touchStartX = null;
  }
  if (slider) {
    slider.addEventListener('touchstart', onTouchStart, { passive: true });
    slider.addEventListener('touchend', onTouchEnd, { passive: true });
  }

  // ====== Перемещение экранов (форми/слайди) ======
  function showSignIn() {
    showOnly(boxSignIn);
    setMode('basic'); // карусель
  }
  function showVerify() {
    showOnly(boxVerify);
    setMode('static');
    showOnlySlide(slideVerify);
  }
  function showNewPassword() {
    showOnly(boxNewPass);
    setMode('static');
    showOnlySlide(slideNewPass);
  }
  function showSuccess() {
    showOnly(boxSuccess);
    setMode('static');
    showOnlySlide(slideSuccess);
  }

  // ====== ИНПУТЫ / ПАРОЛЬ / REMEMBER ======
  // Тумблери "око" — работаем относительно конкретного инпута
  root.querySelectorAll('.input-wrapper .icon-right').forEach(icon => {
    icon.addEventListener('click', () => {
      const wrapper = icon.closest('.input-wrapper');
      if (!wrapper) return;
      const input = wrapper.querySelector('input[type="password"], input[type="text"]');
      if (!input) return;
      input.type = input.type === 'password' ? 'text' : 'password';
    });
  });

  // Remember me — сохранение/подстановка email
  const loginInput = boxSignIn ? boxSignIn.querySelector('#login') : null;
  const rememberCb = boxSignIn ? boxSignIn.querySelector('#remember') : null;
  const LS_KEY = 'darwin.login.email';

  function preloadEmail() {
    try {
      const saved = localStorage.getItem(LS_KEY);
      if (saved && loginInput) {
        loginInput.value = saved;
        if (rememberCb) rememberCb.checked = true;
      }
    } catch {}
  }

  function saveEmailIfNeeded() {
    try {
      if (rememberCb && rememberCb.checked && loginInput && loginInput.value) {
        localStorage.setItem(LS_KEY, loginInput.value.trim());
      } else {
        localStorage.removeItem(LS_KEY);
      }
    } catch {}
  }

  // ====== КНОПКИ ======
  // "Забыли пароль?" → Verify
  root.querySelectorAll('a.forgot-link').forEach(a => {
    a.addEventListener('click', (e) => {
      e.preventDefault();
      showVerify();
    });
  });

  // Кнопка на экране успеха: назад до входа
  const successBackBtn = boxSuccess ? boxSuccess.querySelector('.btn') : null;
  if (successBackBtn) {
    successBackBtn.addEventListener('click', (e) => {
      e.preventDefault();
      showSignIn();
    });
  }

  // ====== САБМІТ ФОРМ ======
  // 1) Вход (мок-логика → редирект на profile.html)
  if (boxSignIn) {
    const form = boxSignIn.querySelector('form');
    const pwd = boxSignIn.querySelector('#password');


  }

  // 2) Отправить инструкции (Verify-Email) — показать экран "Создать новый пароль"
  if (boxVerify) {
    const form = boxVerify.querySelector('form');
    const emailInput = boxVerify.querySelector('#login');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const email = emailInput ? emailInput.value.trim() : '';

      // У продакшені: вызов API восстановления и показа сообщения
      showNewPassword();
    });
  }

  // 3) Установить новый пароль → показать "успешно изменено"
  if (boxNewPass) {
    const form = boxNewPass.querySelector('form');
    const inputs = boxNewPass.querySelectorAll('input[type="password"]');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const [p1, p2] = Array.from(inputs);
      const v1 = p1 ? p1.value : '';
      const v2 = p2 ? p2.value : '';
      if ((v1 || '').length < 6) return alert('Пароль має містити щонайменше 8 символів.');
      if (v1 !== v2) return alert('Паролі не співпадають.');
      // У продакшені: запрос на установку нового пароля
      showSuccess();
    });
  }

  // ====== Инициализация ======
  document.addEventListener('DOMContentLoaded', () => {
    // Стартовый экран — Sign-in
    showSignIn();
    preloadEmail();
  });
})();
