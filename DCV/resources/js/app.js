const app = {
    routes : {
        'inisesion' : '../../resources/views/auth/inisesion.php',
        'login' : '../../../app/app.php', 
        'logout' : '../../app/app.php?logout',
        
    },

    view : function(route){
        location.replace(this.routes[route]);
    }
}