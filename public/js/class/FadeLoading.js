class FadeLoading{

	constructor(fade){
		this.fade = fade;
	}

	fade_loading_open() {
		this.fade.css('display', 'flex');
	}

	fade_loading_close() {
		this.fade.css('display', 'none');
	}

}