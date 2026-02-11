document.addEventListener("DOMContentLoaded", () => {
  // --- Меню языков ---
  const selector = document.querySelector('.language-selector');
  const button = selector; // Используем сам селектор как кнопку

  button.addEventListener('click', (e) => {
    e.stopPropagation();
    selector.classList.toggle('active');
  });

  document.addEventListener('click', () => {
    selector.classList.remove('active');
  });

  // --- Toggle password ---
  document.querySelectorAll('.toggle-password').forEach(toggle => {
    const input = toggle.previousElementSibling;
    let fixed = false; // флаг фиксации

    // Наведение — временно показываем текст
    toggle.addEventListener('mouseenter', () => {
      if (!fixed) input.type = 'text';
    });

    toggle.addEventListener('mouseleave', () => {
      if (!fixed) input.type = 'password';
    });

    // Клик — фиксируем результат
    toggle.addEventListener('click', () => {
      fixed = !fixed;
      input.type = fixed ? 'text' : 'password';
    });
  });

  // --- Меню сообщений ---
  const msgSelector = document.querySelector('.msg-selector');
  const msgMenu = msgSelector.querySelector('.msg-menu');
  const msgBtn = document.querySelector('.notification-icon img'); // открыть по колокольчику
  const msgClose = msgMenu.querySelector('.msg-close-btn');

  msgBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    msgSelector.classList.toggle('active');
  });

  msgClose.addEventListener('click', () => {
    msgSelector.classList.remove('active');
  });

  document.addEventListener('click', (e) => {
    if (!msgSelector.contains(e.target)) {
      msgSelector.classList.remove('active');
    }
  });
});


////// Script_registration.js //////


// Получаем все пункты меню и контентные блоки
const menuItems = document.querySelectorAll(".left-column .menu li")
const contentBlocks = {
  "Профіль дилера": ".profile-content",
  Дашборд: ".Dashboard-content",
  "Трекінг замовлення": ".tracking-order-content",
  WinDraw: ".WinDraw-content",
  Акції: ".promo-block",
  Мотивація: ".motivation-content",
  Фінанси: ".finances-container",
  Рекламації: ".complaints-container",
}

// // Функция скрытия всех контентных блоков
// function hideAllContent() {
//   Object.values(contentBlocks).forEach((selector) => {
//     const block = document.querySelector(selector)
//     if (block) {
//       block.classList.remove("active")
//       block.style.display = "none"
//     }
//   })
// }
//
// // Функция показа конкретного блока
// function showContent(blockName) {
//   hideAllContent()
//
//   const selector = contentBlocks[blockName]
//   if (!selector) {
//     console.error("Селектор не найден для:", blockName)
//     return
//   }
//
//   const block = document.querySelector(selector)
//   if (block) {
//     block.classList.add("active")
//     block.style.display = "block"
//   } else {
//     console.error("Блок не найден в DOM:", selector)
//   }
// }

// // Инициализация: показываем профиль по умолчанию
// hideAllContent()
// showContent("Профіль дилера")

// // Обработчики кликов по меню
// menuItems.forEach((item) => {
//   item.addEventListener("click", () => {
//     // Получаем текст из span, если он есть, иначе из самого элемента
//     const span = item.querySelector("span")
//     const text = span ? span.textContent.trim() : item.textContent.trim()
//
//     if (contentBlocks[text]) {
//       showContent(text)
//       // Убираем активный класс у всех
//       menuItems.forEach((i) => i.classList.remove("active"))
//       // Добавляем активный класс текущему
//       item.classList.add("active")
//     }
//   })
// })

if (menuItems.length > 0) {
  menuItems[0].classList.add("active")
}

// ============================================
// МОБИЛЬНОЕ МЕНЮ
// ============================================

const burgerBtn = document.querySelector(".mobile-left .icon-wrapper")
const mobileMenu = document.querySelector(".mobile-menu")
const mobileMenuItems = document.querySelectorAll(".mobile-menu .menu li")

// Открытие/закрытие мобильного меню
if (burgerBtn && mobileMenu) {
  burgerBtn.addEventListener("click", () => {
    mobileMenu.classList.toggle("active")
  })

  // Закрытие при клике вне меню
  document.addEventListener("click", (e) => {
    if (!mobileMenu.contains(e.target) && !burgerBtn.contains(e.target)) {
      mobileMenu.classList.remove("active")
    }
  })

  // Переключение контента из мобильного меню
  mobileMenuItems.forEach((item) => {
    item.addEventListener("click", () => {
      const text = item.querySelector("span").textContent.trim()
      if (contentBlocks[text]) {
        showContent(text)
        mobileMenu.classList.remove("active")
      }
    })
  })
}

// ============================================
// УВЕДОМЛЕНИЯ И СООБЩЕНИЯ
// ============================================

const notificationIcon = document.querySelector(".notification-icon")
const msgSelector = document.querySelector(".msg-selector")
const msgCloseBtn = document.querySelector(".msg-close-btn")

// Открытие/закрытие меню сообщений
if (notificationIcon && msgSelector) {
  notificationIcon.addEventListener("click", (e) => {
    e.stopPropagation()
    msgSelector.classList.toggle("active")
  })

  // Закрытие по кнопке
  if (msgCloseBtn) {
    msgCloseBtn.addEventListener("click", (e) => {
      e.stopPropagation()
      msgSelector.classList.remove("active")
    })
  }

  // Закрытие при клике вне
  document.addEventListener("click", (e) => {
    if (!msgSelector.contains(e.target) && !notificationIcon.contains(e.target)) {
      msgSelector.classList.remove("active")
    }
  })
}

// ============================================
// ВЫБОР ЯЗЫКА
// ============================================

const languageSelector = document.querySelector(".language-selector")
// Здесь можно добавить выпадающее меню языков, если оно есть в HTML

// ============================================
// ПОПАПЫ (ВСПЛЫВАЮЩИЕ ОКНА)
// ============================================

// Запрос на рахунок
const trackingBtn = document.querySelector(".tracking-btn")
const invoiceRequest = document.querySelector(".invoice-request")
const invoiceOverlay = document.querySelector(".invoice-request-overlay")
const invoiceCloseBtn = document.querySelector(".invoice-request-close")
const invoiceCancelBtn = document.querySelector(".invoice-request-btn-cancel")

if (trackingBtn && invoiceRequest && invoiceOverlay) {
  trackingBtn.addEventListener("click", () => {
    invoiceRequest.classList.add("active")
    invoiceOverlay.classList.add("active")
  })

  // Закрытие попапа
  const closeInvoiceRequest = () => {
    invoiceRequest.classList.remove("active")
    invoiceOverlay.classList.remove("active")
  }

  ;[invoiceCloseBtn, invoiceCancelBtn].forEach((btn) => {
    if (btn) {
      btn.addEventListener("click", closeInvoiceRequest)
    }
  })

  // Закрытие по клику на оверлей
  invoiceOverlay.addEventListener("click", closeInvoiceRequest)
}

// Деталі замовлення
const orderDetails = document.querySelector(".order-details")
const orderOverlay = document.querySelector(".order-details-overlay")
const orderCloseBtn = document.querySelector(".order-close")

if (orderCloseBtn && orderDetails && orderOverlay) {
  // Закрытие попапа
  const closeOrderDetails = () => {
    orderDetails.classList.remove("active")
    orderOverlay.classList.remove("active")
  }

  orderCloseBtn.addEventListener("click", closeOrderDetails)

  // Закрытие по клику на оверлей
  orderOverlay.addEventListener("click", closeOrderDetails)
}

// Открытие деталей заказа из таблицы (через попап действий)
const tablePopupOrder = document.querySelector(".table-popup-order")
const actionIcons = document.querySelectorAll(".action-icon")

actionIcons.forEach((icon) => {
  icon.addEventListener("click", (e) => {
    e.stopPropagation()
    const rect = icon.getBoundingClientRect()
    if (tablePopupOrder) {
      tablePopupOrder.style.top = `${rect.bottom + 5}px`
      tablePopupOrder.style.left = `${rect.left - 150}px`
      tablePopupOrder.classList.toggle("active")
    }
  })
})

// Клик по "Деталі замовлення" в попапе
if (tablePopupOrder) {
  const detailsItem = tablePopupOrder.querySelector(".table-popup-item:first-child")
  const invoiceItem = tablePopupOrder.querySelector(".table-popup-item:last-child")

  if (detailsItem && orderDetails && orderOverlay) {
    detailsItem.addEventListener("click", () => {
      tablePopupOrder.classList.remove("active")
      orderDetails.classList.add("active")
      orderOverlay.classList.add("active")
    })
  }

  if (invoiceItem && invoiceRequest && invoiceOverlay) {
    invoiceItem.addEventListener("click", () => {
      tablePopupOrder.classList.remove("active")
      invoiceRequest.classList.add("active")
      invoiceOverlay.classList.add("active")
    })
  }
}


// Попап расширения (выбор количества записей)
const tablePopupExtension = document.querySelector(".table-popup-extension")
const footerSelect = document.querySelector(".footer-select")

if (footerSelect && tablePopupExtension) {
  footerSelect.addEventListener("click", (e) => {
    e.stopPropagation()
    const rect = footerSelect.getBoundingClientRect()
    tablePopupExtension.style.top = `${rect.bottom + 5}px`
    tablePopupExtension.style.left = `${rect.left}px`
    tablePopupExtension.classList.toggle("active")
  })

  // Выбор значения
  const extensionItems = tablePopupExtension.querySelectorAll(".table-popup-extension-item")
  extensionItems.forEach((item) => {
    item.addEventListener("click", () => {
      footerSelect.querySelector("span").textContent = item.textContent
      tablePopupExtension.classList.remove("active")
    })
  })
}

// Попап сортировки по дате
const tablePopupSort = document.querySelector(".table-popup-sort")
const controlRangeBtns = document.querySelectorAll(
  ".control-range, .control-dashboard-btn.control-range, .control-motivation-btn.control-range",
)

controlRangeBtns.forEach((btn) => {
  btn.addEventListener("click", (e) => {
    e.stopPropagation()
    const rect = btn.getBoundingClientRect()
    const tablePopupMotivation = document.querySelector(".table-popup-motivation")

    // Закрываем все попапы
    if (tablePopupSort) tablePopupSort.classList.remove("active")
    if (tablePopupMotivation) tablePopupMotivation.classList.remove("active")

    // Открываем нужный попап
    if (btn.classList.contains("control-motivation-btn")) {
      if (tablePopupMotivation) {
        tablePopupMotivation.style.top = `${rect.bottom + 5}px`
        tablePopupMotivation.style.left = `${rect.left}px`
        tablePopupMotivation.classList.add("active")
      }
    } else {
      if (tablePopupSort) {
        tablePopupSort.style.top = `${rect.bottom + 5}px`
        tablePopupSort.style.left = `${rect.left}px`
        tablePopupSort.classList.add("active")
      }
    }
  })
})

// Выбор периода
if (tablePopupSort) {
  const sortItems = tablePopupSort.querySelectorAll(".table-popup-sort-item")
  sortItems.forEach((item) => {
    item.addEventListener("click", () => {
      const text = item.textContent
      controlRangeBtns.forEach((btn) => {
        const textNode = Array.from(btn.childNodes).find(
          (node) => node.nodeType === Node.TEXT_NODE && node.textContent.trim().includes("днів"),
        )
        if (textNode) {
          textNode.textContent = ` ${text} `
        }
      })
      tablePopupSort.classList.remove("active")
    })
  })
}

// Выбор периода для мотивации
const tablePopupMotivation = document.querySelector(".table-popup-motivation")
if (tablePopupMotivation) {
  const motivationItems = tablePopupMotivation.querySelectorAll(".table-popup-sort-item")
  motivationItems.forEach((item) => {
    item.addEventListener("click", () => {
      const text = item.textContent
      const motivationBtn = document.querySelector(".control-motivation-btn")
      if (motivationBtn) {
        const textNode = Array.from(motivationBtn.childNodes).find(
          (node) => node.nodeType === Node.TEXT_NODE && node.textContent.trim().includes("днів"),
        )
        if (textNode) {
          textNode.textContent = ` ${text} `
        }
      }
      tablePopupMotivation.classList.remove("active")
    })
  })
}

// Попап программ мотивации
const mpPopup = document.querySelector(".mp-popup")
const mpPopupOverlay = document.querySelector(".mp-popup-overlay")
const mpPopupClose = document.querySelector(".mp-popup-close")
const detailsBtns = document.querySelectorAll(".table-finance-Status-btn.Details")

detailsBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (mpPopup && mpPopupOverlay) {
      mpPopup.classList.add("active")
      mpPopupOverlay.classList.add("active")
    }
  })
})

if (mpPopupClose && mpPopup && mpPopupOverlay) {
  mpPopupClose.addEventListener("click", () => {
    mpPopup.classList.remove("active")
    mpPopupOverlay.classList.remove("active")
  })
}

// Закрытие по клику на оверлей
if (mpPopupOverlay && mpPopup) {
  mpPopupOverlay.addEventListener("click", () => {
    mpPopup.classList.remove("active")
    mpPopupOverlay.classList.remove("active")
  })
}

// Закрытие по клику вне попапа
document.addEventListener("click", (e) => {
  if (mpPopup && mpPopup.classList.contains("active")) {
    if (!mpPopup.contains(e.target) && !e.target.closest(".table-finance-Status-btn.Details")) {
      mpPopup.classList.remove("active")
      if (mpPopupOverlay) mpPopupOverlay.classList.remove("active")
    }
  }

  // Закрытие выпадающих списков
  if (tablePopupSort && tablePopupSort.classList.contains("active")) {
    if (!tablePopupSort.contains(e.target) && !e.target.closest(".control-range")) {
      tablePopupSort.classList.remove("active")
    }
  }

  if (tablePopupMotivation && tablePopupMotivation.classList.contains("active")) {
    if (!tablePopupMotivation.contains(e.target) && !e.target.closest(".control-motivation-btn")) {
      tablePopupMotivation.classList.remove("active")
    }
  }
})

// Попапы рекламаций
const complaintsPopup = document.querySelector(".new-complaint-popup")
const reportPopup = document.querySelector(".complaints-popup.report-popup")
const newComplaintBtn = document.querySelector(".New-complaint-btn")

if (newComplaintBtn && complaintsPopup) {
  newComplaintBtn.addEventListener("click", () => {
    complaintsPopup.classList.add("active")
  })
}

// Обработка кнопок закрытия для попапа списка рекламаций (без оверлея)
const reportCloseBtns = document.querySelectorAll(".report-popup-close")
const reportCancelBtns = document.querySelectorAll(".complaints-popup.report-popup .complaints-btn.cancel")

reportCloseBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (reportPopup) reportPopup.classList.remove("active")
  })
})

reportCancelBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (reportPopup) reportPopup.classList.remove("active")
  })
})

// Закрытие попапа рекламаций по клику вне попапа
document.addEventListener("click", (e) => {
  if (reportPopup && reportPopup.classList.contains("active")) {
    if (!reportPopup.contains(e.target) && !e.target.closest('.complaints-status[data-status="Details"]')) {
      reportPopup.classList.remove("active")
    }
  }
})

// Открытие деталей рекламации
const complaintsDetailsBtns = document.querySelectorAll('.complaints-status[data-status="Details"]')
complaintsDetailsBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (reportPopup) reportPopup.classList.add("active")
  })
})

const tablePopupFile = document.querySelector(".table-popup-file")
// fileActionIcons не найдены в HTML, поэтому закомментируем
// const fileActionIcons = document.querySelectorAll(".file-action-icon")

// fileActionIcons.forEach((icon) => {
//   icon.addEventListener("click", (e) => {
//     e.stopPropagation()
//     const rect = icon.getBoundingClientRect()
//     if (tablePopupFile) {
//       tablePopupFile.style.top = `${rect.bottom + 5}px`
//       tablePopupFile.style.left = `${rect.left - 150}px`
//       tablePopupFile.classList.toggle("active")
//     }
//   })
// })

// Закрытие попапов при клике вне
document.addEventListener("click", (e) => {
  if (tablePopupOrder && !tablePopupOrder.contains(e.target) && !e.target.classList.contains("action-icon")) {
    tablePopupOrder.classList.remove("active")
  }
  if (tablePopupStatus && !tablePopupStatus.contains(e.target) && !e.target.classList.contains("status-btn")) {
    tablePopupStatus.classList.remove("active")
  }
  if (tablePopupExtension && !tablePopupExtension.contains(e.target) && !e.target.closest(".footer-select")) {
    tablePopupExtension.classList.remove("active")
  }
  if (
    tablePopupSort &&
    !tablePopupSort.contains(e.target) &&
    !e.target.closest(".control-range, .control-dashboard-btn, .control-motivation-btn")
  ) {
    tablePopupSort.classList.remove("active")
  }
  // if (tablePopupFile && !tablePopupFile.contains(e.target) && !e.target.classList.contains("file-action-icon")) {
  //   tablePopupFile.classList.remove("active")
  // }
})

// ============================================
// ВКЛАДКИ В ДЕТАЛЯХ ЗАКАЗА
// ============================================

const orderMenuItems = document.querySelectorAll(".order-menu-item")
const orderFooterTables = document.querySelectorAll(".order-footer-table")

// Функция переключения вкладок в деталях заказа
function switchOrderTab(index) {
  // Убираем активный класс у всех вкладок во всех таблицах
  document.querySelectorAll(".order-menu-item").forEach((item) => {
    item.classList.remove("active")
  })

  // Скрываем все таблицы
  orderFooterTables.forEach((table) => {
    table.style.display = "none"
  })

  // Показываем нужную таблицу
  if (orderFooterTables[index]) {
    orderFooterTables[index].style.display = "block"
    // Активируем соответствующую вкладку в видимой таблице
    const activeMenuItems = orderFooterTables[index].querySelectorAll(".order-menu-item")
    if (activeMenuItems[index]) {
      activeMenuItems[index].classList.add("active")
    }
  }
}

// Обработчики для всех вкладок
orderMenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    // Определяем индекс вкладки (0-3)
    const parent = item.closest(".order-footer-table")
    const siblings = parent.querySelectorAll(".order-menu-item")
    const tabIndex = Array.from(siblings).indexOf(item)

    switchOrderTab(tabIndex)
  })
})

// Инициализация: показываем первую вкладку (Склад замовлення)
if (orderFooterTables.length > 0) {
  switchOrderTab(0)
}

// ============================================
// ВКЛАДКИ В ТРЕКИНГЕ ЗАКАЗОВ
// ============================================

const trackingMenuBtns = document.querySelectorAll(".tracking-order-menu button")

trackingMenuBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    trackingMenuBtns.forEach((b) => b.classList.remove("active"))
    btn.classList.add("active")
    // Здесь можно добавить фильтрацию таблицы по статусу
  })
})

if (trackingMenuBtns.length > 0) {
  trackingMenuBtns[0].classList.add("active")
}

// ============================================
// ВКЛАДКИ В ФИНАНСАХ
// ============================================

const financesMenuItems = document.querySelectorAll(".finances-menu-item")

financesMenuItems.forEach((item) => {
  item.addEventListener("click", () => {
    financesMenuItems.forEach((i) => i.classList.remove("active"))
    item.classList.add("active")
    // Здесь можно переключать контент (Рухи/Зведення)
  })
})

if (financesMenuItems.length > 0) {
  financesMenuItems[0].classList.add("active")
}

// ============================================
// ПЕРЕКЛЮЧЕНИЕ ВИДИМОСТИ ПАРОЛЯ
// ============================================

const togglePasswordBtns = document.querySelectorAll(".toggle-password")

togglePasswordBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const input = btn.previousElementSibling
    if (input && input.type === "password") {
      input.type = "text"
      const img = btn.querySelector("img")
      if (img) img.src = "images/eye-off.svg"
    } else if (input) {
      input.type = "password"
      const img = btn.querySelector("img")
      if (img) img.src = "images/eye.svg"
    }
  })
})

// ============================================
// МЕНЮ ПРОФИЛЯ
// ============================================

const profileMenuItems = document.querySelectorAll(".profile-menu li")
const profileInfoWrapper = document.querySelector(".profile-info-wrapper")
const departmentContacts = document.querySelector(".department-contacts")

profileMenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    profileMenuItems.forEach((i) => i.classList.remove("active"))
    item.classList.add("active")

    if (index === 0) {
      // Мій профіль
      if (profileInfoWrapper) profileInfoWrapper.style.display = "block"
      if (departmentContacts) departmentContacts.style.display = "none"
    } else if (index === 1) {
      // Контакти відділів
      if (profileInfoWrapper) profileInfoWrapper.style.display = "none"
      if (departmentContacts) departmentContacts.style.display = "block"
    }
  })
})

// Инициализация: показываем профиль и активируем первую вкладку
if (profileMenuItems.length > 0) {
  profileMenuItems[0].classList.add("active")
}
if (profileInfoWrapper) profileInfoWrapper.style.display = "block"
if (departmentContacts) departmentContacts.style.display = "none"

// ============================================
// МОБИЛЬНЫЕ КНОПКИ ПЕРЕКЛЮЧЕНИЯ РАЗДЕЛОВ ПРОФИЛЯ
// ============================================

const mobileSectionSwitchBtns = document.querySelectorAll(".mobile-section-switch-btn")

mobileSectionSwitchBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const target = btn.getAttribute("data-target")

    if (target === "profile") {
      // Переходим к профилю
      if (profileInfoWrapper) profileInfoWrapper.style.display = "block"
      if (departmentContacts) departmentContacts.style.display = "none"

      // Активируем соответствующую вкладку в меню
      profileMenuItems.forEach((item, index) => {
        item.classList.remove("active")
        if (index === 0) item.classList.add("active")
      })
    } else if (target === "contacts") {
      // Переходим к контактам отделов
      if (profileInfoWrapper) profileInfoWrapper.style.display = "none"
      if (departmentContacts) departmentContacts.style.display = "block"

      // Активируем соответствующую вкладку в меню
      profileMenuItems.forEach((item, index) => {
        item.classList.remove("active")
        if (index === 1) item.classList.add("active")
      })
    }
  })
})

// ============================================
// WINDRAW СОСТОЯНИЯ
// ============================================

const winDrawCards = document.querySelectorAll(".WinDraw-card")
const winDrawFooterButtons = document.querySelectorAll(".WinDraw-footer-button")

// Функция переключения состояний WinDraw
function showWinDrawState(stateIndex) {
  winDrawCards.forEach((card, index) => {
    card.style.display = index === stateIndex ? "flex" : "none"
  })
}

// Инициализация: показываем первое состояние (Loading)
if (winDrawCards.length > 0) {
  showWinDrawState(0)

  // Симуляция загрузки (переход к Successful через 3 секунды)
  setTimeout(() => {
    showWinDrawState(1)
  }, 3000)
}

// Обработчики кнопок в WinDraw
winDrawFooterButtons.forEach((btn) => {
  btn.addEventListener("click", () => {
    const text = btn.textContent.trim()

    if (text.includes("Відкрити зараз")) {
      // Здесь можно добавить редирект на WinDraw
    } else if (text.includes("Повторити")) {
      showWinDrawState(0) // Возврат к Loading
      setTimeout(() => {
        showWinDrawState(1) // Переход к Successful
      }, 3000)
    } else if (text.includes("Запросити доступ")) {

      // Здесь можно добавить форму запроса доступа
    }
  })
})

// Обработчики текстовых ссылок "Повернутися на дашборд"
const winDrawFooterTexts = document.querySelectorAll(".WinDraw-footer-text")
winDrawFooterTexts.forEach((text) => {
  if (text.textContent.includes("Повернутися на дашборд")) {
    text.style.cursor = "pointer"
    text.addEventListener("click", () => {
      showContent("Дашборд")
      menuItems.forEach((item) => {
        if (item.textContent.trim() === "Дашборд") {
          menuItems.forEach((i) => i.classList.remove("active"))
          item.classList.add("active")
        }
      })
    })
  }
})

// ============================================
// ЧЕКБОКСЫ В INVOICE REQUEST
// ============================================

const invoiceCheckboxes = document.querySelectorAll(".invoice-request-checkbox input[type='checkbox']")
invoiceCheckboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", (e) => {
    // Снимаем выбор с соседнего чекбокса в той же группе
    const parent = e.target.closest(".invoice-request-col")
    if (parent) {
      const siblings = parent.querySelectorAll("input[type='checkbox']")
      siblings.forEach((sibling) => {
        if (sibling !== e.target) {
          sibling.checked = false
        }
      })
    }
  })
})

// ============================================
// ПОПАП РЕКЛАМАЦИЙ
// ============================================

// Нова рекламація
const complaintsOverlay = document.querySelector(".complaints-popup-overlay")
const complaintsCloseBtn = document.querySelector(".new-complaint-popup-close")
const complaintsCancelBtn = document.querySelector(".complaints-btn.cancel")

if (newComplaintBtn && complaintsPopup && complaintsOverlay) {
  // Открытие попапа
  newComplaintBtn.addEventListener("click", () => {
    complaintsPopup.classList.add("active")
    complaintsOverlay.classList.add("active")
  })
}

if (complaintsCloseBtn && complaintsPopup && complaintsOverlay) {
  // Закрытие попапа
  const closeComplaintsPopup = () => {
    complaintsPopup.classList.remove("active")
    complaintsOverlay.classList.remove("active")
  }

  complaintsCloseBtn.addEventListener("click", closeComplaintsPopup)

  // Закрытие по клику на оверлей
  complaintsOverlay.addEventListener("click", closeComplaintsPopup)
}

if (complaintsCancelBtn && complaintsPopup && complaintsOverlay) {
  complaintsCancelBtn.addEventListener("click", () => {
    complaintsPopup.classList.remove("active")
    complaintsOverlay.classList.remove("active")
  })
}

// ============================================
// ЗАКРЫТИЕ ПОПАПОВ ПО ESC
// ============================================

document.addEventListener("keydown", (e) => {
  if (e.key === "Escape") {
    document.querySelectorAll(".invoice-request, .order-details, .mp-popup, .complaints-popup").forEach((popup) => {
      popup.classList.remove("active")
    })
    document.querySelectorAll(".mp-popup-overlay, .invoice-request-overlay, .order-details-overlay, .complaints-popup-overlay").forEach((overlay) => {
      overlay.classList.remove("active")
    })
    document.querySelectorAll(".table-popup").forEach((popup) => {
      popup.classList.remove("active")
    })
    if (mobileMenu) mobileMenu.classList.remove("active")
    if (msgSelector) msgSelector.classList.remove("active")
  }
})

document.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("invoice-request") ||
    e.target.classList.contains("order-details") ||
    e.target.classList.contains("mp-popup") ||
    e.target.classList.contains("complaints-popup")
  ) {
    e.target.classList.remove("active")
  }
})

// ============================================
// DRAG & DROP ДЛЯ ФАЙЛОВ
// ============================================

const uploadAreas = document.querySelectorAll('.complaints-upload-box, .extra-row img[src*="upload-cloud"]')

uploadAreas.forEach((area) => {
  area.addEventListener("dragover", (e) => {
    e.preventDefault()
    area.style.borderColor = "#00A651"
    area.style.backgroundColor = "rgba(0, 166, 81, 0.05)"
  })

  area.addEventListener("dragleave", () => {
    area.style.borderColor = ""
    area.style.backgroundColor = ""
  })

  area.addEventListener("drop", (e) => {
    e.preventDefault()
    area.style.borderColor = ""
    area.style.backgroundColor = ""
    const files = e.dataTransfer.files

    Array.from(files).forEach((file) => {

    })
    // Здесь можно добавить обработку загрузки файлов
  })

  area.addEventListener("click", () => {
    const input = document.createElement("input")
    input.type = "file"
    input.multiple = true
    input.onchange = (e) => {
      const files = e.target.files

      Array.from(files).forEach((file) => {

      })
    }
    input.click()
  })
})

// ============================================
// ПАГИНАЦИЯ
// ============================================

const paginationBtns = document.querySelectorAll(".footer-btn")

paginationBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (!btn.classList.contains("prev") && !btn.classList.contains("next")) {
      paginationBtns.forEach((b) => b.classList.remove("active-page"))
      btn.classList.add("active-page")

    } else if (btn.classList.contains("prev")) {

    } else if (btn.classList.contains("next")) {

    }
  })
})

const pageInput = document.querySelector(".footer-page-input")
if (pageInput) {
  pageInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      const pageNum = Number.parseInt(pageInput.value)
      if (pageNum && pageNum > 0) {

        pageInput.value = ""
      }
    }
  })
}

const firstPageBtn = document.querySelector(".footer-btn:not(.prev):not(.next)")
if (firstPageBtn) {
  firstPageBtn.classList.add("active-page")
}

// ============================================
// ДОПОЛНИТЕЛЬНЫЕ ОБРАБОТЧИКИ
// ============================================

const updateBtn = document.querySelector(".update-btn")
if (updateBtn) {
  updateBtn.addEventListener("click", () => {

    // Здесь можно добавить логику обновления данных
    updateBtn.disabled = true
    updateBtn.textContent = "Оновлення..."
    setTimeout(() => {
      updateBtn.disabled = false
      updateBtn.innerHTML = '<img src="images/round-arrow.svg" alt="Оновити"> Оновити дані'
    }, 2000)
  })
}

const invoiceSubmitBtn = document.querySelector(".invoice-request-btn-submit")
if (invoiceSubmitBtn) {
  invoiceSubmitBtn.addEventListener("click", () => {

    // Здесь можно добавить валидацию и отправку формы
    const inputs = document.querySelectorAll(".invoice-request-input")
    let isValid = true

    inputs.forEach((input) => {
      if (!input.value.trim()) {
        input.style.borderColor = "red"
        isValid = false
      } else {
        input.style.borderColor = ""
      }
    })

    if (isValid && invoiceRequest) {
      invoiceRequest.classList.remove("active")

    } else {
    }
  })
}

const complaintsCreateBtns = document.querySelectorAll(".complaints-btn.create")
complaintsCreateBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    if (complaintsPopup) complaintsPopup.classList.remove("active")
    if (reportPopup) reportPopup.classList.remove("active")
  })
})


const completeParticipationBtn = document.querySelector(".mp-popup-complete-btn")
if (completeParticipationBtn) {
  completeParticipationBtn.addEventListener("click", () => {
    const confirmed = confirm("Ви впевнені, що хочете завершити участь у програмі?")
    if (confirmed) {
      if (mpPopup && mpPopupOverlay) {
        mpPopup.classList.remove("active")
        mpPopupOverlay.classList.remove("active")
      }
    }
  })
}


// Попап статусов
const tablePopupStatus = document.querySelector(".table-popup-status")
const statusBtns = document.querySelectorAll(".status-btn[data-type]")


// Маппинг текста кнопки к классу этапа в попапе
const statusMapping = {
  "Прорахунок": "status-btn-rahunok",
  "Погодження": "status-btn-pogodzenya",
  "Оплата": "status-btn-oplata",
  "Виробництво": "status-btn-vyrobnytctvo",
  "Логістика": "status-btn-logistica",
  "Рекламація": "status-btn-reklamaciya",
  "Виконано": "status-btn-vykonano",
  "Рахунок": "status-btn-rahunok" // Рахунок соответствует Прорахунку
}

statusBtns.forEach((btn) => {
  // Hover - показываем попап с подсветкой
  btn.addEventListener("mouseenter", (e) => {
    const rect = btn.getBoundingClientRect()
    const buttonText = btn.textContent.trim()

    if (tablePopupStatus) {
      // Позиционируем попап над кнопкой по центру
      const popupWidth = 352; // ширина попапа
      const popupHeight = 200; // примерная высота попапа
      const buttonCenter = rect.left + (rect.width / 2);
      const popupLeft = buttonCenter - (popupWidth / 2);

      // Позиционируем попап ближе к кнопке
      tablePopupStatus.style.top = `${rect.top - popupHeight + 54}px`
      tablePopupStatus.style.left = `${popupLeft}px`
      tablePopupStatus.classList.add("active")

      // Убираем активный класс у всех этапов
      const allStatusBtns = tablePopupStatus.querySelectorAll(".status-btn")
      allStatusBtns.forEach(statusBtn => {
        statusBtn.classList.remove("status-btn-active")
      })

      // Подсвечиваем соответствующий этап
      const targetClass = statusMapping[buttonText]
      if (targetClass) {
        const targetBtn = tablePopupStatus.querySelector(`.${targetClass}`)
        if (targetBtn) {
          targetBtn.classList.add("status-btn-active")
        }
      }
    }
  })

  // Mouseleave - скрываем попап
  btn.addEventListener("mouseleave", () => {
    // Небольшая задержка, чтобы пользователь мог перейти на попап
    setTimeout(() => {
      if (tablePopupStatus && !tablePopupStatus.matches(':hover')) {
        tablePopupStatus.classList.remove("active")
      }
    }, 100)
  })
})

// Позволяем наводить на сам попап
if (tablePopupStatus) {
  tablePopupStatus.addEventListener("mouseleave", () => {
    tablePopupStatus.classList.remove("active")
  })
}

// Выпадающие списки для кнопок выбора дат в финансах
const financesDateBtns = document.querySelectorAll(".finances-date-btn")
const financesDatePopups = document.querySelectorAll(".table-popup-finances-date")

financesDateBtns.forEach((btn, index) => {
  const popup = financesDatePopups[index]

  if (popup) {
    btn.addEventListener("click", (e) => {
      e.stopPropagation()

      // Закрываем все другие попапы
      financesDatePopups.forEach(p => p.classList.remove("active"))

      // Позиционируем попап
      const rect = btn.getBoundingClientRect()
      popup.style.top = `${rect.bottom + 5}px`
      popup.style.left = `${rect.left}px`

      // Показываем попап
      popup.classList.add("active")
    })

    // Обработка выбора элемента
    const items = popup.querySelectorAll(".table-popup-sort-item")
    items.forEach(item => {
      item.addEventListener("click", () => {
        const text = item.textContent.trim()
        const btnText = btn.querySelector(".btn-text")
        if (btnText) {
          btnText.textContent = text
        }
        popup.classList.remove("active")
      })
    })
  }
})

// Закрытие по клику вне попапа
document.addEventListener("click", (e) => {
  if (!e.target.closest(".finances-date-btn") && !e.target.closest(".table-popup-finances-date")) {
    financesDatePopups.forEach(popup => {
      popup.classList.remove("active")
    })
  }
  // Попап списания знижки
  const discountWriteoffBtn = document.querySelector(".finances-panel-head .discount-writeoff-btn")
  const discountWriteoffPopup = document.querySelector(".discount-writeoff-popup")
  const discountWriteoffOverlay = document.querySelector(".discount-writeoff-overlay")
  const discountWriteoffCloseBtn = document.querySelector(".discount-writeoff-close")
  const discountWriteoffCancelBtn = document.querySelector(".discount-writeoff-btn-cancel")


  // Проверяем родительский элемент
  const parentElement = discountWriteoffBtn.parentElement

  if (discountWriteoffBtn && discountWriteoffPopup && discountWriteoffOverlay) {


    // Добавляем глобальный обработчик для отладки
    document.addEventListener("click", (e) => {
      if (e.target.closest(".discount-writeoff-btn")) {
      }
    }, true) // Используем capture phase

    // Открытие попапа
    discountWriteoffBtn.addEventListener("click", (e) => {

      discountWriteoffPopup.classList.add("active")
      discountWriteoffOverlay.classList.add("active")


    })

    // Функция закрытия попапа
    const closeDiscountWriteoffPopup = () => {
      discountWriteoffPopup.classList.remove("active")
      discountWriteoffOverlay.classList.remove("active")
    }

    // Закрытие по кнопке закрытия
    if (discountWriteoffCloseBtn) {
      discountWriteoffCloseBtn.addEventListener("click", closeDiscountWriteoffPopup)
    }

    // Закрытие по кнопке отмены
    if (discountWriteoffCancelBtn) {
      discountWriteoffCancelBtn.addEventListener("click", closeDiscountWriteoffPopup)
    }

    // Закрытие по клику на оверлей
    discountWriteoffOverlay.addEventListener("click", closeDiscountWriteoffPopup)
  }
})





