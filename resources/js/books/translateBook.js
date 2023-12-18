const btnsTranslate = document.querySelectorAll('.btn-translate');

const translate = (btn) => {
    btn.innerHTML = 'Идет перевод ...';

    fetch(`http://localhost/api/book/${btn.id}/translate`)
        .then(r => r.json())
        .then(r => {
            btn.innerHTML = 'Переведено' + ' ' + r.id + ' | ' + r.name;
            btn.innerHTML = `<a href='http://localhost/translate/${r.id}/download'>Скачать ${r.name}</a>`;
            btn.removeEventListener('click', () => translate(btn));
        })
}

for (const btn of btnsTranslate) {
    btn.addEventListener('click', () => {
        translate(btn);
    });
}
