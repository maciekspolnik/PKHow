const searchfaq = document.querySelector('input[placeholder="Wyszukaj"]');
const projectContainer = document.querySelector(".faq");

searchfaq.addEventListener("keyup", function(event)
{

    if(event.key === "Enter")
    {
        event.preventDefault();
        const data = {search: this.value};


        fetch("/searchfaq",{
            method: "POST",
            headers:
                {
                    'Content-Type': 'application/json'
                },
            body: JSON.stringify(data)
        }).then(function(response)
        {
            return response.json();
        }).then(function(faqs){
            projectContainer.innerHTML = "";
            loadFAQs(faqs)
        })
    }
});

function loadFAQs(faqs)
{
    faqs.forEach(
        faq => {
            createFAQs(faq);
        })
}

function createFAQs(faq)
{
    const template = document.querySelector("#faq-template");
    const clone = template.content.cloneNode(true);


    const question = clone.querySelector(".question");
    question.innerHTML = faq.question;
    const answer = clone.querySelector(".answer");
    answer.innerHTML = faq.answer;

    projectContainer.appendChild(clone);

}