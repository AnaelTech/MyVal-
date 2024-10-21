document.addEventListener('turbo:load', function() {

    let loader = document.getElementById('loader');
    let pageContent1 = document.getElementById('page-content-1');
    let pageContent2 = document.getElementById('page-content-2');
    let percentage = document.getElementById('loading-percentage');
    let navbar = document.getElementById('navbar');
    let progress = 0;
    let loaderFinished = sessionStorage.getItem('loaderFinished'); 

    
    if (loader && pageContent1 && pageContent2 && percentage && navbar) {
        let progress = 0;
        let loaderFinished = sessionStorage.getItem('loaderFinished'); 

    if (!loaderFinished) {
        
        navbar.style.display = 'none';
        pageContent1.style.display = 'none';
        pageContent2.style.display = 'none';
        loader.style.display = 'block';  
        percentage.innerText = "0%";     
        document.querySelector('#loader .bg').style.width = "0%"; 
        function simulateLoading() {
            progress += 1;
            percentage.innerText = progress + "%"; 


            if (progress < 100) {
                setTimeout(simulateLoading, 100);  
            } else {
                setTimeout(function() {  
                    loader.style.display = 'none';
                    navbar.style.display = 'block';
                    pageContent1.style.display = 'block';
                    pageContent2.style.display = 'block';
                    sessionStorage.setItem('loaderFinished', true);
                    console.log("Loader terminé et contenu affiché.");
                }, 300);
            }
        }
        simulateLoading(); 
    } else {
        loader.style.display = 'none';  
        navbar.style.display = 'block'; 
        pageContent1.style.display = 'block';
        pageContent2.style.display = 'block';
    } 
}
});
