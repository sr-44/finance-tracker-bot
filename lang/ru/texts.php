<?php

return [
    'welcome' => 'Добро пожаловать в бот, :name. Бот поможет вам отслежевать ваши финансы. Выберите нужное вам меню ниже',
    'start' => 'Доброго времени суток, :name, выберите нужное меню',
    'help' => 'mdkmk',

    'expenses.menu' => 'Тут вы можете добавить свои расходы в течении дня.
Ваши недавно добавленные отчеты:
:recent

Добавьте сумму в виде цифр. Например: 990',

    'incomes.menu' => 'Тут вы можете добавить свои доходы в течении дня.
Ваши недавно добавленные отчеты:
:recent

Добавьте сумму в виде цифр. Например: 9900',

    'expenses.choose_category' => 'Пожалуйста выберите категорию вашего отчета о расходе',
    'expenses.set_description' => 'Пожалуйста введите описание вашего расхода. Если хотите оставить пустым, тогда отправьте 0',
    'expenses.succes' => 'Новый отчет о расходе добавлен!',


    'incomes.choose_category' => 'Пожалуйста выберите категорию вашего отчета о доходе',
    'incomes.set_description' => 'Пожалуйста введите описание вашего отчета о доходе. Если хотите оставить пустым, тогда отправьте 0',
    'incomes.succes' => 'Новый отчет о доходе добавлен!',
    
    'profile' => 'это ваш кабинет',
    'numeric_pls' => 'Пожалуйста введите число',
    'task.name' => 'Введите название задачи',
    'task.type' => 'Принято, теперь выберите тип задачи',
    'task.deadline' => "Выберите дату дедлайна (необязательно)",
    'task.deadline_own' => "Введите дату дедлайна \n Формат: :format \n Пример: :example",
    'task.description' => 'Введите описание для вашей задачи (необязательно)',
    'task.deleted' => 'Задача успешно удалена!',
    'task.done' => 'Ваша задача успешно создано!',
    'task.congratulate' => "Ура 🥳, вы сделали это!\nОсталось всего лишь :count задач(и)",
    'task.none' => 'Эй у вас еще нет ни одной задачи🤭',
    'task.send_users' => 'У вас есть :count задачи, которые нужно выполнить сейчас, вы сделали их?',
    'task.all' => "Вот все ваши задачи :)\nСтраница: :page",
    'invalid_format' => 'Неправильный формат, пожалуйста соблюдайте правила',
    'unknown' => 'Бот вас не понимает, пожалуйста действуйте по указанию',
    'unknown_error' => 'Неизвестная ошибочка 🙃',
    'nothing' => 'Там ничего нет, брать 😑',
    'come_back' => 'Эээй, вернитесь, я по вам скучаю🥺',

    //Keyboard texts
    'kbd.main' => 'Главное меню 🏠',
    'kbd.tasks' => 'Задачи 📝',
    'kbd.add_incomes' => 'Добавить доход',
    'kbd.add_expense' => 'Добавить расход',
    'kbd.next' => 'След. :status',
    'kbd.middle' => ':current / :total',
    'kbd.prev' => ':status Пред.',
    'kbd.cancel' => 'Отмена ⤵',
    'kbd.done' => 'Готово ✅',
    'kbd.skip' => 'Пропустить ⏭',
    'kbd.delete' => 'Удалить ❌',
    'kbd.back' => 'Назад 🔙',
    'kbd.help' => 'Помощь ❓',
    'kbd.profile'=> 'Профиль ⚙',
    'kbd.own'=> 'Свой вариант ⚙',
    'kbd.simple'=> 'Обычный',
    'kbd.daily'=> 'Ежедневный',
    'kbd.select' => 'Выберите меню ниже',
    'kbd.close' => 'Закрыт ❌',
    'kbd.notification' => 'Уведомление :status',


    //Категория доходов и расходов
    'expenses.category.food' => 'еда',
    'expenses.category.transport'=> 'транспорт',
    'expenses.category.housing' => 'жилье',
    'expenses.category.health' => 'здоровье',
    'expenses.category.travel' => 'путешествие',
    'expenses.category.education' => 'образование',
    'expenses.category.hobbies' => 'хобби',
    'expenses.category.gifts' => 'подарки',
    'expenses.category.electronics' => 'электроника',
    'expenses.category.etc'  => 'прочее',
    
    'incomes.category.salary'=> 'Зарплата',
    'incomes.category.sales' => 'Продажи',
    'incomes.category.etc' => 'Прочее',
    
];
