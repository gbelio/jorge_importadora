Pasos a seguir para iniciar la aplicación:

1.- php artisan migrate --seed

    1.1 - Genera la base de datos y ejecuta el seed para generar el color #1 (Sin Color) NECESARIO para la lógica de colores


2.- Generar el primer usuario y admin:

    2.1 - RegisterController.php --> descomentar guest y comentar admin en el constructor()
    2.2 - UserController.php --> comentar el if the store() --> if (Auth::user() == null) { return redirect('login'); }