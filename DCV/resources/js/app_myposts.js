const app_myposts ={

    url: "../../app/app.php",

    mp : $("#my-posts"),//document.querySelector("#my-posts")

    pt : $("#post-title"),

    pb : $("#post-body"),
    


    getMyPosts : function(uid){
        var html ="";
        this.mp.html("");//this.mp.innerHTML ="",
        fetch(this.url + "?mp&id=" + uid)
            .then( response => response.json())
            .then ( mpresp => {
                //console.table(mpresp);
                for(let post of mpresp){
                    html += `
                        <tr>
                            <td><button type="button" onclick="app_myposts.viewPost(${post.id})" class="btn btn-link" data-toggle="modal" data-target="#post-modal">${ post.title }</button></td>
                            <td>${ post.fecha}</td>
                            <td>
                                <button type="button" onclick="" class="btn btn-link btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                <button type="button" onclick="app_myposts.deletePost(${post.id})" class="btn btn-link btn-sm text-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    `;
                }

                this.mp.html(html);
            }).catch( err => console.log( err ));

    },
    viewPost : function(id) {
        var html = "";
        var html1 = "";
        this.pt.html("");
        this.pb.html("");

        fetch(this.url + "?vp&id=" + id)
            .then( response => response.json())
            .then( vpresp => {
                console.table(vpresp);
                html += `
                <h4 class="modal-title">${vpresp[0].title}</h5>
                `;
                html1 += `
                <p>${vpresp[0].body}</p>
                `;
                this.pt.html(html);
                this.pb.html(html1);
            }).catch( err => console.log( err ));
    },

    deletePost : function(id) {
        var alert = confirm("Can not be undone. Confirm if sure.");
        if (alert == true) {
            window.location.href = this.url + "?dp&id=" + id;
        } else {
            console.log("No");
        }
    }



}