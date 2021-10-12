const articles = document.getElementById('contentz');

if (articles) {
    console.log(123123);

    articles.addEventListener('click', (e ) => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Are you sure?')){
                const id = e.target.getAttribute('data-id');

                fetch(`/artikelen/delete/${id}`,{
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}