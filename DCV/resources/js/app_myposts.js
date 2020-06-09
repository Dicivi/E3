const app_myposts ={

    url: "/DCV/app/app.php",

    mp : $("#my-posts"),//document.querySelector("#my-posts")

    getMyPosts : function(uid){
        var html ="";
        this.mp.html("");//this.mp.innerHTML ="",
        fetch(this.url + "?mp&id=" + uid)
            .then( response => response.json())
            .then ( mpresp => {
                //console.table(mpresp);
                for(let post of mpresp){
                    html+=`
                        <tr>
                            <td><button type="button" onclick="app_myposts.viewPost(${ post.id }" class="btn btn-link">${ post.title }</button></td>
                            <td>${ post.fecha }</td>
                            <td>
                                <button type="button" onclick="" class="btn btn-link bin-sm"><i class="fas fa-pencil-alt"></button>
                                <button type="button" onclick="app_myposts.deletePost(${ post.id })" class="btn btn-link bin-sm text-danger"><i class="fas fa-trash-alt"></button>
                            </td>
                        </tr>
                    `;
                }
                this.mp.html(html);
            }).catch( err => console.log( err ));

    }

}