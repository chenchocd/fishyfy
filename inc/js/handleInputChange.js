document.addEventListener('DOMContentLoaded',()=>{

    const product_select = document.getElementById('preparation_name')
    const hidden_select = document.getElementById('preparation_name_hidden')
    if(product_select){
        product_select.addEventListener('change',(e)=>{
            const select_value = e.target.value
            hidden_select.value = select_value
            console.log(hidden_select)
        })
    }
    

    
})