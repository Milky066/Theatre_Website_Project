class Navbar extends HTMLElement {
  constructor() {
    super();
    this._backgroundColor = 'red';
    this._color = '#fff'; // Use an underscore to store the color property internally
    this._style = '';
  }

  get backgroundColor() {
    return this.getAttribute('background-color') || this._backgroundColor;
  }

  set backgroundColor(value) {
    this.setAttribute('background-color', value);
  }

  get color() {
    return this._color;
  }

  set color(value) {
    this._color = value; // Set the internal property _color
    this.style.color = value; // Set the color of the element's text
  }

  get style(){
    return this.getAttribute('style') || this._style;
  }

  set style(value){
    this._style = value;
    this.setAttribute('style', value); 
  }



    connectedCallback() {

      this._style = this.getAttribute('style');

      this.innerHTML = `
            <style>
            .header-navbar {
                background-color: ${this.backgroundColor};
                color: ${this.color};
                ${this._style};
            }
            
            .header-navbar ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }

            .header-navbar li {
                display: inline;
                margin-right: 20px;
            }

            .header-navbar a {
                text-decoration: none;
                color: ${this.color};
            }
            </style>
      <nav class="header-navbar">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </nav>
    
          `;
    }
  }
  
  //Footer
  
  class Footer extends HTMLElement {
    constructor() {
      super();
      this._backgroundColor = 'red';
      this._color = '#fff'; // Use an underscore to store the color property internally
      this._style = '';
    }
  
    get backgroundColor() {
      return this.getAttribute('background-color') || this._backgroundColor;
    }
  
    set backgroundColor(value) {
      this.setAttribute('background-color', value);
    }
  
    get color() {
      return this._color;
    }
  
    set color(value) {
      this._color = value; // Set the internal property _color
      this.style.color = value; // Set the color of the element's text
    }
    get style(){
      return this.getAttribute('style') || this._style;
    }
  
    set style(value){
      this._style = value;
      this.setAttribute('style', value); 
    }
    connectedCallback() {
      this._style = this.getAttribute('style');
      this.innerHTML = `
      <style>
      footer {
          background-color: ${this.backgroundColor};
          color: ${this.color};
          padding: 20px;
          text-align: center;
          ${this._style};
      }
      ul {
        list-style: none;
        padding: 0;
        margin-right: 10px;
      }

      ul li {
        display: inline;
      }

      .footer-container {
        display: flex;
        margin-right: 10px;
        justify-content: space-between;
      }
    </style>

    <footer>
          <div class="footer-container">
              <div>
                  <p>&copy; JhaMil Theatre</p>
              </div>
              <div>
                  <ul>
                      <li><a href="#">Privacy Policy</a></li>
                      <li><a href="#">Terms of Service</a></li>
                      <li><a href="#">Contact Us</a></li>
                  </ul>
              </div>
          </div>
    </footer>
  
        `;
    }
  }
  
  customElements.define("theatre-header", Navbar);
  customElements.define("theatre-footer", Footer);
  