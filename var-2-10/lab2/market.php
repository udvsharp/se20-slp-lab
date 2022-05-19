<?php

$AGE_MIN = 4;
$AGE_MAX = 199; // 200 - нельзя!

$username = "";
$userAge = 0;

$PRODUCTS = [
    1 => ['name' => 'Вода', 'price' => 10, 'amount' => 25, 'minAge' => '6'],
    2 => ['name' => 'Хліб', 'price' => 30, 'amount' => 21, 'minAge' => '10'],
    3 => ['name' => 'Масло', 'price' => 70, 'amount' => 12, 'minAge' => '12'],
    4 => ['name' => 'Морозиво', 'price' => 120, 'amount' => 17, 'minAge' => '18']
];

$MENU = [
    1 => 'Розпочати покупки',
    2 => 'Отримати кінцеву вартість',
    3 => 'Налаштування профіля',
    0 => 'Вийти з програми'
];

$OPTIONS = [
    1 => 'Змінити імя',
    2 => 'Змінити вік',
    0 => 'Вийти з налаштувань'
];

//  Read options
$username = readline("Введіть ваше імя: ");
while (true) {
    $age = (int)readline("Введіть ваш вік: ");
    if ($age <= $AGE_MIN || $age > $AGE_MAX) {
        echo ("Вік має бути у проміжку між $AGE_MIN та $AGE_MAX\n");
    } else {
        $userAge = $age;
        break;
    }
}

// Init basket and show menu
$productsList = [];
showMenu();

function showMenu(): void
{
    global $MENU;

    while (true) {
        echo ("Оберіть команду зі списку:\n");
        foreach ($MENU as $k => $v) {
            echo ("$k — $v\n");
        }
        $option = (int)readline("Ваш вибір: ");
        switch ($option) {
            case 1:
                chooseProducts();
                break;
            case 2:
                showTotalPrice();
                break;
            case 3:
                showSettings();
                break;
            case 0:
                break 2;
            default:
                echo "Команда відсутня\n Спробуйте ще раз!\n";
                break;
        }
        echo "_____________________________\n";
    }
}

function chooseProducts(): void
{
    while (true) {
        printProductsList();
        $choice = (int)readline("Оберіть продукти зі списку\nАбо натисніть 0, щоб вийти: ");

        if ($choice == 0) {
            break;
        } else if (selectOption($choice) && isAllowedByAge($choice)) {
            addProductToList($choice);
        }
        echo ("_____________________________\n");
    }
}

function selectOption($option): bool
{
    global $PRODUCTS;

    $max = sizeof($PRODUCTS);
    if ($option > 0 && $option <= $max) {
        return true;
    } else {
        echo ("Обраного вами продукту немає у списку. Перевірте, значення має бути від 0 до $max\n");
        return false;
    }
}

function isAllowedByAge($option): bool
{
    global $PRODUCTS, $userAge;

    $minAge = $PRODUCTS[$option]['minAge'];
    if ($userAge >= $minAge) {
        return true;
    } else {
        echo ("Вам недозволено купувати цей продукт. Ця опція продається з $minAge років\n");
        return false;
    }
}

function addProductToList($option): void
{
    global $PRODUCTS, $productsList;

    while (true) {
        $amount = (int)readline("Введіть кількість: ");
        if (productListEndReached($option, $amount)) {
            if (isset($productsList[$option])) {
                $productsList[$option] += $amount;
            } else {
                $productsList[$option] = $amount;
            }

            $PRODUCTS[$option]['amount'] -= $amount;
            break;
        }
    }
}

function productListEndReached($option, $amount): bool
{
    global $PRODUCTS;

    $max = $PRODUCTS[$option]['amount'];
    if ($amount > 0 && $amount <= $max) {
        return true;
    } else {
        echo ("Недопустима кількість, вона повинна бути у промужку від 0 до $max\n");
        return false;
    }
}

function printProductsList(): void
{
    global $PRODUCTS;

    $result = "Продукти:\n";
    foreach ($PRODUCTS as $key => $details) {
        $result .= "$key =>";
        foreach ($details as $d => $v) {
            $result .= " | $d: $v";
        }
        $result .= "\n";
    }
    print($result);
}

function showTotalPrice(): void
{
    global $PRODUCTS, $productsList, $userAge;

    $result = 0;
    foreach ($productsList as $key => $quantity) {
        if ($PRODUCTS[$key]['minAge'] <= $userAge) {
            $result += $quantity * $PRODUCTS[$key]['price'];
        }
    }
    echo ("$result\n");
}

function showSettings(): void
{
    global $OPTIONS, $username, $userAge;
    global $AGE_MIN, $AGE_MAX;

    while (true) {
        echo ("Ваше імя: $username\n");
        echo ("Ваш вік: $userAge\n");

        echo ("Оберіть налаштування зі списку:\n");
        foreach ($OPTIONS as $k => $v) {
            echo ("$k — $v\n");
        }

        $option = (int)readline("Вибір: ");
        switch ($option) {
            case 1:
                $username = readline("Введіть ваше імя: ");
                break;
            case 2:
                while (true) {
                    $age = (int)readline("Введіть ваш вік: ");
                    if ($age <= $AGE_MIN || $age > $AGE_MAX) {
                        echo ("Вік має бути у проміжку між $AGE_MIN та $AGE_MAX\n");
                    } else {
                        $userAge = $age;
                        break;
                    }
                }
                break;
            case 0:
                break 2;
            default:
                echo "Команда відсутня.\nСпробуйте ще раз!\n";
                break;
        }
    }
}
