const btnsBookTitle = document.querySelectorAll('.btn-book-title');

for (const btn of btnsBookTitle) {
    btn.addEventListener('click', (e) => {

        let description = document.getElementById(`book-description-${btn.id}`);
        description.innerHTML = 'Идет загрузка ...';
        description.classList.contains('hidden') ? description.classList.remove('hidden') : '';

        fetch(`http://localhost/api/book/${btn.id}/description`)
            .then(r => r.json())
            .then(r => {
                description.innerHTML = r.description;
            })
    })
}
