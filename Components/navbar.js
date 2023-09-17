class Navbar extends HTMLElement {
    connectedCallback() {
      this.innerHTML = `
                <style>
            .header-navbar {
                background-color: #333;
                color: #fff;
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
                color: #fff;
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
    connectedCallback() {
      this.innerHTML = `
      <style>
      /* Add your custom CSS styles for the footer here */
      footer {
          background-color: #333;
          color: white;
          padding: 20px;
          text-align: center;
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
  