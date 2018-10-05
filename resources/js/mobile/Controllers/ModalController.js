class ModalController {
    constructor() {

        this.active = 0;
        this.flag = true;
        console.log(ngDialog);

    };

    closeModal(){
        this.flag = !this.flag;

    }

};



export {ModalController};