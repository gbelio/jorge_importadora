php artisan migrate --seed genera la base de datos y ejecuta el seed para generar el color #1 (Sin Color) NECESARIO para la lógica de colores

Para generar el primer usuario: RegristerController.php --> descomentar guest y comentar admin en el constructor() y en el UserController.php comentar el if the store() --> if (Auth::user() == null) { return redirect('login'); }