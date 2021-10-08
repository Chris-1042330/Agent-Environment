const articles = document.getElementById('content');

if (articles) {
    console.log(123123);

    articles.addEventListener('click', (e ) => {
        if(e.target.className === 'btn btn-danger delete-article'){
            if(confirm('Are you sure?')){
                const id = e.target.getAttribute('data-id');

                fetch(`/article/delete/${id}`,{
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}