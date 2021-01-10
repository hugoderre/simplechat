

class Chat {
    constructor() {

        // Binds
        this.init = this.init.bind(this)
        this.handleSubmit = this.handleSubmit.bind(this);

        this.init();
        setInterval(this.init, 2000);

        // Events
        const button = document.getElementById('submit');
        button.addEventListener('click', this.handleSubmit, false)
        document.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                this.handleSubmit();
            }
        }.bind(this), false)

    }

    init() {
        getAjax(`chat.php/?init=1`, function (data) {
            data = JSON.parse(data);
            this.render(data);
        }.bind(this));
    }

    handleSubmit() {
        const pseudo = document.getElementById('pseudo');
        const message = document.getElementById('message');
        if (!pseudo.value) {
            pseudo.classList.add("error-notice");
            return;
        }
        if (!message.value) {
            message.classList.add("error-notice");
            return;
        }

        pseudo.classList.remove("error-notice");
        message.classList.remove("error-notice");

        getAjax(`chat.php/?pseudo=${pseudo.value}&message=${message.value}&update=1`, function (data) {
            message.value = '';
            data = JSON.parse(data);
            this.render(data);
        }.bind(this));
    }

    render(data) {
        const renderDOM = document.getElementById('chat-messages');
        const html = data.map((element, index) => {

            return (
                `<div class="msg" id="msg-${index}">
                        <div class="msg_pseudo"><b>${element.pseudo}</b> :</div>
                        <div class="msg_content">${element.content}</div>
                    </div>`
            )

        }).join('')
        renderDOM.innerHTML = html;
    }
}

new Chat();
