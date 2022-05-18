# LB1 - Group 2 - Variant 10
- [Task doc](https://dl.nure.ua/pluginfile.php/524588/mod_resource/content/1/Skan_PI_Ml_SMP_2020_ukr.pdf), page 16
    - Tasks #N, #(N+3), #(N+6)
- Tasks 10, 13, 16
    - task 10: `./task10.sh` - через дескрипторы пишет `Hello, World!` в `test.txt`;
    - task 13: `./task13.sh test1.txt Hey!!!` - то же самое, что и task 10, но первый параметр - файл, а второй - сообщение;
    - task 16: `./task16.sh 100 436` - перемножает два числа с помощью команды `expr`.
        - Note: `expr` - архаизм. Сейчас используют просто `$((...))`
    - theory: `./theory.sh 1 2 3 <other>` - демо всего, что было в главе.