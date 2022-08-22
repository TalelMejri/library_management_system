
 window.addEventListener('scroll',function(){
    const header=document.querySelector('nav');
    header.classList.toggle('sticky',window.scrollY>0);
 })

