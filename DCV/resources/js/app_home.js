const app_home ={

    url: "../../app/app.php",

    pp : $("#previous-posts"),
    lp : $("#last-post"), 

    previousPosts : function(){
        var html ="";
        this.pp.html("");
        fetch(this.url + "?pp")
            .then( response => response.json())
            .then( ppresp => {
                for( let post of ppresp){
                    html += `
                        <a href="#" onclick="app_home.openPost( event, ${ post.id } , this)" class="list-group-item list-group-item-action pplg">
                            <div class="d-flex w-100 justify-content-between border-bottom">
                                <h5 class="mb-1">${ post.title }</h5>
                                <small>${ post.fecha }</small>
                            </div>
                            <p class="mb-1">${ post.body.substr(1,100) }...<b>see more</b></p>
                            <small class="text-secondary" >By: <b>${ post.name }</b> </small>
                        </a>
                     `;
                }
                    this.pp.html(html);
            }).catch( err => console.log( err ));

    } ,
    lastPost : function(limit){
        var html = "";
        this.lp.html("");
        fetch(this.url + "?lp&limit=" + limit)
            .then( response => response.json())
            .then( lpresp => {
                html = `
                    <div class="w-100 border-bottom mb-3">
                        <h3 class"mb=1">${ lpresp[0].title }</h3>
                        <small>By: <b>${ lpresp[0].name }</b> | ${ lpresp[0].fecha }</small>
                    </div>
                    <p class"mb-1 py-2 lead text-justify">${ lpresp[0].body }</p>
                `;
                this.lp.html(html);
                
            }).catch(err => console.log( err ));
    },

    openPost : function(e,id,el){
        $(".pplg").removeClass("active");
        el.classList.add("active");
        e.preventDefault();
        var html = "";
        this.lp.html("");
        fetch(this.url + "?op&id=" + id)
        .then( response => response.json() )
        .then( opresp => {
        
                html = `
                <div class="w-100 border-bottom mb-3">
                    <h3 class"mb=1">${ opresp[0].title }</h3>
                    <small>By: <b>${ opresp[0].name }</b> | ${ opresp[0].fecha }</small>
                </div>
                <p class"mb-1 py-2 lead text-justify">${ opresp[0].body }</p>
            `;
            
                this.lp.html(html);
                
            }).catch(err => console.log( err ));
    }
    
   
}



