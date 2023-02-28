/* page index*/

let table = [1,2,3,4,5,6,7,8,9,10]

function toggle(id){
    
    let res = table.filter(val => val !== id)

    for(let ligne=0;ligne<res.length;ligne++){
        let post = document.querySelectorAll('.post_'+res[ligne])
        
        if(post.length !== 0){
            for(let val=0;val<post.length;val++){
                post[val].classList.toggle('hidden')
            }
        }
    }
}


/* pages create et edit*/

let compteur = document.getElementById('content')
let cpt = document.getElementById('cpt')

cpt.innerHTML=compteur.value.length+'/105'

compteur.addEventListener('keyup',function(){
    cpt.innerHTML=this.value.length+'/105'
    if(this.value.length <= 105){
        cpt.style.color='black'
    }else{
        cpt.style.color='red'
    }
})