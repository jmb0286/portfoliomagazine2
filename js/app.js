// REDIRECCIONAMIENTO A LECCIONES
// let selectHTML = document.querySelector('#selectHTML');

// selectHTML.addEventListener('change', ()=>{

//     window.location.href='paginas/portfolio/lecciones.php?id='+ selectHTML.value;

// });

// // CARGA DE LECCIONES CSS
// let selectCSS = document.querySelector('#selectCSS');

// selectCSS.addEventListener('change', ()=>{

//     window.location.href='paginas/portfolio/lecciones.php?id='+ selectCSS.value;

// });

let selectFrontend = document.querySelectorAll('.select-frontend');

selectFrontend.forEach(select => {
    select.addEventListener('change', ()=>{

        window.location.href='paginas/portfolio/lecciones.php?id='+ select.value;
    
    }); 
});

let selectBackend = document.querySelectorAll('.select-backend');

selectBackend.forEach(select => {
    select.addEventListener('change', ()=>{

        window.location.href='paginas/portfolio/lecciones.php?id='+ select.value;
    
    }); 
});


let selectProgramas = document.querySelectorAll('.select-programas');

selectProgramas.forEach(select => {
    select.addEventListener('change', ()=>{

        window.location.href='paginas/portfolio/lecciones.php?id='+ select.value;
    
    }); 
});

let selectGrafico = document.querySelectorAll('.select-grafico');

selectGrafico.forEach(select => {
    select.addEventListener('change', ()=>{

        window.location.href='paginas/portfolio/lecciones.php?id='+ select.value;
    
    }); 
});


let selectAudioVisual = document.querySelectorAll('.select-audiovisual');

selectAudioVisual.forEach(select => {
    select.addEventListener('change', ()=>{

        window.location.href='paginas/portfolio/lecciones.php?id='+ select.value;
    
    }); 
});