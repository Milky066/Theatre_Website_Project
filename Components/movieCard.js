class MovieCard extends HTMLElement {
    constructor(src, alt, price, seat, showtime) {
        super();
        this._src = src;
        this._alt = alt;
        this._price = price;
        this._seat = seat;
        this._showtime = showtime
    }

    get seat() {
        return this._seat;
    }

    set seat(value){
        this._seat = value;
        this.render();
    }

    get price() {
        return this._price;
    }
    
    set price(value){
        this._price = value;
        this.render();
    }

    get src() {
        return this._src;
    }

    set src(value) {
        this._src = value;
        this.render();
    }

    get alt() {
        return this._alt;
    }

    set alt(value) {
        this._alt = value;
        this.render();
    }

    get showtime() {
        return this._showtime;
    }

    set showtime(value) {
        this._showtime = value;
        this.render();
    }

    connectedCallback() {
        this._src = this.getAttribute("src");
        this._alt = this.getAttribute("alt");
        this._price = parseFloat(this.getAttribute("price"));
        this._seat = parseInt(this.getAttribute("seat"));
        this._size = parseInt(this.getAttribute("size"));
        this._showtime = this.getAttribute("showtime");
        this.render();
        showtimeToDate(this.showtime);
        showtimeToTime(this.showtime);
    }



    render() {
        this.innerHTML = `
            <div style="width: ${this.size}px; height: ${this.size + 100}px; background-color: gray; margin: 15px; text-align: center; padding-top: 1rem; padding-bottom: 1rem;">
                <!-- Picture -->
                <div style="margin: auto">
                    <img src="${this.src}" alt="${this.alt}" width="auto" height="auto" style="max-width:200px; max-height:200px;"/>
                </div>

                <div style="padding: 1rem;">
                    <div>
                        <b>${this.alt}</b>
                    </div>
                    <div>
                        Price: ${this.price}
                    </div>
                    <div>
                        Available Seat: ${this.seat}
                    </div>
                    <div>
                        Date: <b>${showtimeToDate(this.showtime)}</b>
                    </div>
                    <div>
                        Showtime: <b>${showtimeToTime(this.showtime)}</b>
                    </div>
                </div>
            </div>
        `;
    }
}

function showtimeToDate(showtime){
    const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const date = new Date(showtime);
    // console.log(`${daysOfWeek[date.getDay()]} ${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`);
    return `${daysOfWeek[date.getDay()]} ${date.getDate()}/${date.getMonth()}/${date.getFullYear()}`;
}

function showtimeToTime(showtime){
    const date = new Date(showtime);
    // console.log(`${date.getHours()}:${date.getMinutes()}`);
    return `${date.getHours()}:${date.getMinutes().toLocaleString('en-US', { minimumIntegerDigits: 2 })}`;
}

customElements.define("movie-card", MovieCard);
