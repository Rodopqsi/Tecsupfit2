<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- Footer -->
<footer id="footerr">

    <div class="footer-container">
        <div class="subscribe-section">
            <h4>Suscríbete y mantente al día</h4>
            <div class="subscribe-form">
                <input type="email" placeholder="Tu correo electrónico">
                <button>Suscríbete</button>
            </div>
            <label>
                <input type="checkbox"> Aceptar los términos y condiciones y la política de privacidad
            </label>
        </div>

        <div class="footer-links">
            <div>
                <h5>LA EMPRESA</h5>
                <ul>
                    <a href="/products"><li>Catálogo</li></a>
                    <a href="{{ route('marcas.index') }}"><li>Marcas</li></a>
                    
                    
                </ul>
            </div>

            <div>
                <h5>AYUDA AL CLIENTE</h5>
                <ul>
                    <a href="/politicas_de_envio"><li>Política de envíos</li></a>
                    <a href="/politicas_de_devoluciones"><li>Política de devoluciones</li></a>
                    <a href="/politicas_privacidad"><li>Política de privacidad</li></a>
                    <a href="/terminos_y_condiciones"><li>Términos y condiciones</li></a>
                </ul>
                <a href="libro-reclamaciones" target="_blank">
                    <svg width="125" height="37" viewBox="0 0 125 37" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <rect width="124.632" height="37" fill="url(#pattern0_204_124)"/>
                    <defs>
                    <pattern id="pattern0_204_124" patternContentUnits="objectBoundingBox" width="1" height="1">
                    <use xlink:href="#image0_204_124" transform="scale(0.00520833 0.0175439)"/>
                    </pattern>
                    <image id="image0_204_124" width="192" height="57" preserveAspectRatio="none" xlink:href="data:image/png;base64,                    iVBORw0KGgoAAAANSUhEUgAAAMAAAAA5CAYAAABgQSTWAAAShklEQVR4Xu1cBVhU2Rc/mLsixv7tbrATFYuwdkXFTmzERExMbOzGQGzEXAtMEIy1FVvXdo21cwVs8X9/x31vZ4aRGJ7Fe+f7/                   NSZd++799zzO33HLFuOXB9JI40DKuWAmQYAlZ68tm3mgAYATRBUzQGzxk2baS6QqkVA3ZvXLIC6z1/1u9cAoHoRUDcDNACo+/               xVv3sNAKoXAXUzQAOAus9f9bvXAKB6EVA3AzQAqPv8Vb97DQCqFwF1M0ADgLrPX/W71wCgehFQNwM0AKj7/FW/ew0AqhcBdTNAA4C6z1/1u9cAoHoRUDcDNAAoeP79+vah7Tt20J9/                  Xog2a926jvTh/XvxfRBZWVpSrVo1aZb3bAXfHvepyltbU9GiRWjJ0mVxH5RIn9QAoNDBmpmZ0d+3bpB7n760bt36aLPOnzeX3rx9S73ce5NT/fo0dcokKlDISqG3x2+anj26U/              NmTamqrX38BibCp39IACRJkoRsbCqSTcWKVKZMacqVMydlyZKFRo4eQ/7+K77ZMd25fZPce/        ehdes3RFtDoYIFKepjFF29eo0BMGXyRCpoWfibrBUAaNa0KVWz0wDwQwEgZcqU1K1rF2rbxpkyZ84cTXiioqKoW4+etGXL1m8iWAAANPz6DRujvd/              RsY5wgT7QjqAgGQBlrSvQsKFDGMAnT52irdu20blz5+Wx7r3caGdICHV26UQvXoTTiJGj+LuSJUqwC1W0SBE6e+4cBe/cSWfPnjO651SpUlH9enXJ3s6OfvnlF/           Lx9aXCVlbRAFCtalWqUaM6FSlcmC5cvEhz5/nQvXv3vgkfv+ZLfxgAODjY0+SJE1jTx0QfPnwgl85dWCi+NsUEgHlzZ9Ob12+od99+DIC5c7zp5s2b9Pffd+jI0aNkZ2vL1qynWy/             auCmAl475Hj56ROfPn6fAwC209vffydm5NU0cP44OHzlCBw8eoipVKhN8+j59+/P3hvTHnt2UP38+8l2wgN69e08dO7Snhw8f0nsBRskCDOjfj3q79+KY4NmzZ7y+iMgIquNY72uz8Ku/                 74sCIH369FS5ciUqVrQo5c6dizJmyCiu4RM9ePCANVZA4OZYtUzy5Mlp7OhRfPBxpfci2Gzl3IYOHDgY1yGKPBdfAKxZu5b69hvA7/7pp59owXwfKlasKJUuay0DYJa3N02cNEV            +5uTxY7Rr927q0bOXvGZfMc6mYgUqXrK03j7AsxGew6iTiyv9sW8ff1euXFnyW7qEHj9+wgBIly4dnT97Ws9y4dz27g5lK         +Az31cR3nyvk3wxADRu1JBmzZwR675hZg8fOUqLlyyhEydO6j2fIcP/aKEw2dbW5WKdx/CBiIhIcmrQkC5euhTvsaYOiC8ArAoXpfCICPl1VsI1Cd0ZRL/            WcWQFgflcu3ajrVu38TOwgsuXLaViJUqxppYoe/ZsdPTwIWrWoqUe6Jf7LaPw8BfUvYeb3pa8xo6hqlWqMAAaNnCi2d6zaOYsb4L1lKiecJtu37pNbdq1N5UdP8S4LwKAJo0b0Yzp0wiZkfiQ/           4qVNHnKFNZOP//8M+0K3cn+sakE96FefSd2M74GxRQE+8ydQ2/evOEskeQCZc+ZW29ZWbNmpbCjh6llK2fW2JjPpbMrp05BkrAajoOff             +XSBT2w4PnNAZvo3PlzNHjIML33wOWpV7cuA6BtmzY0ftxYmjY9urK6eeuW0YzW1+Dl13qH4gBo2aK5yHBMMnn9r1+/ps6uXShNmrQ0Z/Ysk+eRBl67dp0c69bT07QJnvQzE8TXAnTo6KIXq8A/                 HyPcPbhA8NMxH9wXBM4g+PLw6bt170mBmzfLq0BGZ/q0KWRTqQrdun1b/nzihPFka1uN7B1q0KtXr+TPQ4J3UIoUKRkAcIkCNm4g6wo2dPfuXfkZJBngqiZ2UhQAPbp3oyGDByWYZ+MnTKT79+/                TzBnTEzwXJkCw2LK1swj83isy3+cmgcCiuCX523gOmZ+jx46RsSA4MjKShnmOoJDQUGrgVJ+Ff+Wq1TTAYyC/whAA               +Azz1KxRgzyHjxDgCSHHOnVo5AhP2hQQIMcT0voKFMhPQdu3sWvpNW48QbkMHjSQsz1QDFIQvG7tGkqWLBm5dunKQXeF8uXJf/              kyEZC7U1Bw8Bfl2beeXDEAjBwxnNN1SpBSAHjy5AndFhrxlTj47dt30KLFS5RY3mfngMAaEnx8+PqGLtA4rzHsdvTv11dYuzQ8bJtYI6yfRIYuED5HsAwQ1KpZU34OaVekX40Rsks+PnPJInVq/        vrQocMUdvw41fntNxkAadOmJX8RLyALJdGChYto5KjRX5Rf38PkigDAc9hQ6trFVbH9MACE+Z0p4oj4EALenUIrHgsLo+PHT9Dz58/jM/ybPVuqVCmijx/           p1OnTcV5DieLFyTy1Of3zzz9GWy90J0L+39KyEF2+fIWgFD5HSDbAEly//pcq3B/wIcEAQACFQEpJio8FgIZdtGixcB1W0Z07d8myUCGuEpcoUZxy5crFywoPD+fDPyWKTTuCgoWsab8GqeR5/         chzJQgAkydNpFYtWyi+/7hYAAj7gkWLuPWhYoUK7NfWqF6dcuTILq/nytWrIqP0WG99sBDzfRcovmZtwh         +TAyYDALln22rVOOugmz8GG5CWy54tu6jaZqasWbNw9RYdkJkyZYoTl2KyAAjofObP59Qg/GAE3ciOgC6KEv6+ffsp7MQJOipqCwjoDAkm/ksHw3HapPbQd8EBkwFgyupR2IK/               W1r8KVmyBFWuVEmk41JEmwoAeCDSgDOmTZW/                  Q0puzFgvbhPIli0beQ4bInpcPpXqb9y4QccFMNBaALcHvS5WVpaUNGlSvbkxx67dezgjoltIMmUv2pjEwYEEAQBdmalFduHFixes5XPmzMFBFD5H2wMEHsKaIUMGzl4gKL1w4QIHqeiZR3ObvZ0             tNWzYUGQlfpU5augCLfPzo7Fe40Uvyzty69mD/0jAQSrxrqgm37lzR7RV3Oe/4R7dvXc3mmWSXnBLFHjwjNKE+wC6hMLXMr/lHIMoRej7KVKkMC1d5qfUlIrPg5jwkkhIoMfpe6cEASC         +m8sttHNxEZwig4HMBAov6Ny8fOUK4bseok23dauWJFmAqaKgNsBjEKFnBi7X0sWLCQK/avUaOnP2LI9HFkSXAIysAoyZMmdiMOrSx6iP7BYBJBBOpQlpS7Q7P3r8yfUC                +M1TmZOLqysdOxamyOvQytxYVNpR3PpeCYU29Hl5z57zvS5RXpfJAEDas2WLFkKQ0xOapz7X9oAszVOReoNLc+XKVRbcM6fPiBL9eUL7ct68eSlSPPNIBKvIzuCmEqqQyZImo8iXkXJvCzTf9b          +uc5sECBbFwd5OVDLLUZ48udkCoW0Ca4mNYH1q1v7P4sT2fFy/N9YKscB3vigsWVOJUmXiOk2Mz/0IAEC79uMnj7+IlVWEiTqTmAwAX595hB53Uwma/NSp0/SncIn27NlLe/                  bujXUqCwsLatqkMWeeCooLJoYaPtYJ/n0AjWZoOFOajLVCIFGwcsVyudUgtcjdN2jQgKpWrkwoQKHSang1ERVcVHiRl48Ij                 +DvJXcCAGgkGg0dqv9XCGvfri0XtqCEtm3fLs9nbm7O9ZkNGzdRn97uwiJl5SQBGt/QRu3u5sZKCBZXtwaBNbp06sTPwO1cvtyfi3S6VL26A                +EOAe4kYKyvyKxJSYc24r7GpYuXuAIuEfqYbGxsKK0o+u0/eJACAgLZdQbhshCyeLuFHCC2S5E8RbSKOp6rWbMGKz2cPZIhyObp1jW6d+sqvrcXHsVlCg4OiZNMmQwAdHvmyZMnRhkC89DTcv/              +A3EdMGaXAxVbJZrW0D4N9yqdEC4IWNJk+oEwFvzq5Ss+NBw0euSVcoeMAQDCMGGcF1kWLsLvQrcnBHWTEABzkS3D95OnTJXbjiFUq1b6c6yETBeqs6jmSj1BhgBAKhrZMNRBEI+hn2jc+Ak0Z              +48ypQxI508EcaZOqR/kydPxjUbVIMhRBiTV5whOj8bNW4qg2zt6lWcvYMbkzdvHtGm4UTtOnSkkJBQPu9J4l4GXFUACwkI59at6LVwKXF/AMmFnUFwgQJp9py5/DzaMdDmvVDUa9CThDVC                   +B1q1OK/oUi9RecwOoMDN28Rqewc1KhhA2rfsROvG4Q7EAC+/4oV9FKcX5PGjdkjQOMgCJeHwBsoC3gHnTp2oOEjRsZa/Y83AKDRnJzqCYTO4c3jZSizm4s/Fhbib+HzWqSxoNRC+/Bn                   +E78G9obB/TpWXNOlaIFwCI1PjdnYd2//wD3wkj+PbI5ZcuW4TsFtWvVksEGUMH/f/ToMWsd5PqlVOxbce/24cNHXMmUQPfq1WtuidDVFnj/iOGehIAYwqIEGfYC4SDRjw/                tDQFu17Yt9enjzv67lIVC5yx6nspXtGGXAcID64g2ZCl4hrVFfxG6ZQ0B0KJ5M9HyfZmLfCC0WFQS2TU7++oyAEaPGSvXPnADDbfqmrdsxfwGAXDgn3Obdvx/                  XI7BOYDPoPXr1grePeVeIakhD5k03BcAwfVEewbuNly6fFkPAGiOHDtmNHUWY3ft2s3PlypZkvyWLeF3TJg4iQHAHkXd+rIlQiMk3GOACvHhwQP7qLVzW1mro96zd/cuGjrMk1avWUsLF/             jSW6FkpdZv8BV3sDcLQMVE8QIABHbPrhCj1xFNESBkhdC3j9tHCGaTJklK796/47u+EiFARswAIfpLAA6pTRwWNBfahyVC+7SlqDXkz5dXXL7RbzOOaW2IUSraVFakbcJYLxCC/MFDh9HTp08J/            fnZhGbVdSfgxvVy68kHF3Y8jPv6mzRrzlraGBlzgZBtQ4xUSFTBy5QuzXyoYFNJBoBjPScZILAWSxYvpHwFCsmWD9rTSTTj6bpVEDprEbtAuOHu4KwggHAz0PMlXdoxtkZdC4A9I8br2r2H3qOo            30Cp2do7yADQbfOGZURWrVTpsqzNR48aGa1lu3mzZoJPh7jFHG4xgBYorBZuAx4QDZCGCRJja40XANByCwbqCu3Lly/ZT40QWitCpPsgUNBgEeJvPBceEf7v95/             +HymEPVw8H5vbAS1x9dpVHpMQypcvHx8irEEaizQMDlgqEP6dL28e9j2nTkt456muC4Si3yGhteCnTpr86UZX4KaNAsBJuBZhSPg5lagPURQaEswBurGfVsEYQwDs2LaVihcvxpoRsQ18cgBBFw        DQoqfPnOFX4m4wOj11hU13Tqw7aMc2tuCwOpeEdbETqWpYLABg0EAPql27VoxZKF0AbNywjuOBQUOG6m0ZQEJ8guQALABqPro/EgCB9vAYwACARXLt7GLUnUH/                 l3Rh6Nfatcnd3Y2zjJCbOuLOA7peFbMACRFENYw1jAEQeKLbU+q1R39           +fgFIaHhdyijqJMiCwYqdO3OKXQtdQMINRC8TXCJdYZVu3cHdQdsHCFoQ7dKmAgACDuGzFXNKbtrqlSvoQ9QHBoB0KQfWAu6ORAhOJWDrAgAt3tD0dg7Vhe/+Un5+S            +AmMf9zdvViA4BktayKFNOrqUh8w6SwUmFhx1nr45onbs7BasV2oy1eFkANQpyQPRoCAPHRwf1/0KHDh/kOL7I70Ni4MyD9KNbQIYMJfny58hXZKnoM6M8BHTIzq9es4XaTcV5e3O8/               cNBgPQAgOIWvjN/3uX79OgvBvDmzWbBMBcBAj/4i09aEav/myDETwIBAGxYGAEDxEhYCexsitDriD9wDQSZKCqR1AQDrGyzqAgjqx3qNYwEd6OHBhc/        64soqunZjAwDOBIE0YhI30fYNwZZAIbl3iFOePn3GPyoAwv1quNOIvTQLkBCpjsdYY1kgSWNKh43U4kJRG0BSAITYoEu37nxpRyJkPHR/BACX             +zu5dGb3UtcCIHmwZXMgFSxQgIfiCiMKbmgONBUAyOxtDtjImTQQsmWwBMhcAQAgxF4InKX34jMAVsr6GGaBYMEWL1zInQEguMj4+ZrQ0F38/7gAAK7ZSn8/Kix+tkXmk/           ixAPxoAAha33vWTE6TgnChqmGjJno35IwdpWYBjHHlC3+GYh16leDzf65dAM2D6UWR8bHIdEnuzeeWhWuNEFClqs3Q8gimkbKM6Y4CgGaWxIzjldgCTmTd0P8FQlwB4JtC0jsvXLhoNHGBImo            +kT1CzKPrcn3uXRoATDkFbUyi4YAGgERzlNpGTOGABgBTuKaNSTQc0ACQaI5S24gpHNAAYArXtDGJhgMaABLNUWobMYUDGgBM4Zo2JtFwQANAojlKbSOmcEADgClc08YkGg5oAEg0R6ltxBQOaA            AwhWvamETDgf8DiTNX5mnt3C4AAAAASUVORK5CYII="/>
                    </defs>
                    </svg>
                                    </a>
            </div>

            <div>
                <h5>LLÁMANOS</h5>
                <p>‪(+51) 956 104 920‬</p>
                <p>Escríbenos<br>contacto@tecsupfit.pe</p>
                <div class="socials">
                    <a href="#"><i class="ri-facebook-line"></i></a>
                    <a href="https://wa.me/917364262" target="_blank"><i class="ri-whatsapp-line"></i></a>
                    <a href="#"><i class="ri-tiktok-line"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        Copyright © 2025 TecsupFit. Todos los derechos reservados.
    </div>
</footer>
<style>
    footer {
    background-color: #000;
    color: white;
    font-size: 14px;
    padding-top: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}


.footer-container {
    display: flex;
    justify-content: center;
    gap: 130px;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 120px;
    
}

.subscribe-section {
    flex: 1 1 250px;
    max-width: 490px;
}

.subscribe-section h4 {
    margin-bottom: 10px;
}

.subscribe-form {
    display: flex;
    margin-bottom: 10px;
}

.subscribe-form input {
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
    font-weight: 500;
    font-size: .8vw;
    color: #fff;
    background-color: rgb(28,28,30);
    box-shadow: 0 0 .4vw rgba(0,0,0,0.5), 0 0 0 .15vw transparent;
    border-radius: 0.4vw;
    border: none;
    outline: none;
    padding: 0.4vw;
    width: 490px;
    transition: .4s;
}

.subscribe-form input:hover {
    box-shadow: 0 0 0 .15vw rgba(135, 207, 235, 0.186);
}

.subscribe-form input:focus {
    box-shadow: 0 0 0 .15vw skyblue;
}

.subscribe-form button {
    background-color: #888;
    color: white;
    border: none;
    padding: 8px 15px;
    cursor: pointer;
}

footer .social {
    display: flex;
    align-items: center;
    gap: 1rem;
}

footer .socials a {
    color: #ffffff;
    border: 1px solid #ffffff;
    padding: 6px 8px;
    font-size: 1.25rem;
    border-radius: 100%;
    transition: all 0.3 ease;
}

footer .socials a:hover {
    color: #dddddd;
    border: 1px solid #dddddd;
    background-color: 2rem;
    font-size: 1.2rem;
    font-weight: 500;
}

.subscribe-section label {
    font-size: 12px;
}
.socials{
    margin-top: 30px;
}
.footer-links {
    display: flex;
    gap: 70px;
}

.footer-links div h5 {
    margin-bottom: 10px;
    color: #FFF;
    font-family: "Crimson Text";
    font-size: 17px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links ul li {
    margin-bottom: 5px;
    color: #FFF;
    font-family: "Crimson Text";
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.social-icons img {
    width: 24px;
    margin-right: 10px;
}

.footer-bottom {
    text-align: center;
    border-top: 1px solid #444;
    padding: 10px 0;
    font-size: 12px;
}
</style>
<style>
    footer {
    background-color: #000;
    color: white;
    font-size: 14px;
    padding-top: 0;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.footer-container {
    display: flex;
    justify-content: center;
    gap: 130px;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 120px;
}

.subscribe-section {
    flex: 1 1 250px;
    max-width: 490px;
}

.subscribe-section h4 {
    margin-bottom: 10px;
}

.subscribe-form {
    display: flex;
    margin-bottom: 10px;
}

.subscribe-form input {
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue",sans-serif;
    font-weight: 500;
    font-size: .8vw;
    color: #fff;
    background-color: rgb(28,28,30);
    box-shadow: 0 0 .4vw rgba(0,0,0,0.5), 0 0 0 .15vw transparent;
    border-radius: 0.4vw;
    border: none;
    outline: none;
    padding: 0.4vw;
    width: 490px;
    transition: .4s;
}

.subscribe-form input:hover {
    box-shadow: 0 0 0 .15vw rgba(135, 207, 235, 0.186);
}

.subscribe-form input:focus {
    box-shadow: 0 0 0 .15vw skyblue;
}

.subscribe-form button {
    background-color: #888;
    color: white;
    border: none;
    padding: 8px 15px;
    cursor: pointer;
}

footer .social {
    display: flex;
    align-items: center;
    gap: 1rem;
}

footer .socials a {
    color: #ffffff;
    border: 1px solid #ffffff;
    padding: 6px 8px;
    font-size: 1.25rem;
    border-radius: 100%;
    transition: all 0.3 ease;
}

footer .socials a:hover {
    color: #dddddd;
    border: 1px solid #dddddd;
    background-color: 2rem;
    font-size: 1.2rem;
    font-weight: 500;
}

.subscribe-section label {
    font-size: 12px;
}

.socials {
    margin-top: 30px;
}

.footer-links {
    display: flex;
    gap: 70px;
}

.footer-links div h5 {
    margin-bottom: 10px;
    color: #FFF;
    font-family: "Crimson Text";
    font-size: 17px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.footer-links ul {
    list-style: none;
    padding: 0;
}

.footer-links ul li {
    margin-bottom: 5px;
    color: #FFF;
    font-family: "Crimson Text";
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.social-icons img {
    width: 24px;
    margin-right: 10px;
}

.footer-bottom {
    text-align: center;
    border-top: 1px solid #444;
    padding: 10px 0;
    font-size: 12px;
}


/* Tablets grandes - hasta 1200px */
@media (max-width: 1200px) {
    .footer-container {
        gap: 80px;
        padding-top: 30px;
        padding-bottom: 80px;
    }
    
    .subscribe-form input {
        width: 400px;
        font-size: 14px;
        padding: 12px;
        border-radius: 8px;
    }
    
    .footer-links {
        gap: 50px;
    }
}

/* Tablets - hasta 1024px */
@media (max-width: 1024px) {
    .footer-container {
        gap: 60px;
        padding: 30px 20px 60px;
    }
    
    .subscribe-section {
        max-width: 400px;
    }
    
    .subscribe-form input {
        width: 100%;
        max-width: 350px;
        font-size: 14px;
    }
    
    .footer-links {
        gap: 40px;
    }
    
    .footer-links div h5 {
        font-size: 16px;
    }
    
    .footer-links ul li {
        font-size: 14px;
    }
}

/* Tablets pequeñas - hasta 768px */
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        gap: 40px;
        align-items: flex-start;
        padding: 30px 20px 50px;
    }
    
    .subscribe-section {
        width: 100%;
        max-width: none;
        text-align: center;
    }
    
    .subscribe-section h4 {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .subscribe-form {
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }
    
    .subscribe-form input {
        width: 100%;
        max-width: 300px;
        font-size: 14px;
        padding: 12px;
        border-radius: 8px;
    }
    
    .subscribe-form button {
        width: 100%;
        max-width: 300px;
        padding: 12px;
        border-radius: 8px;
        font-size: 14px;
    }
    
    .subscribe-section label {
        font-size: 12px;
        text-align: center;
        display: block;
        margin-top: 10px;
    }
    
    .footer-links {
        width: 100%;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 30px;
    }
    
    .footer-links > div {
        flex: 1 1 45%;
        min-width: 200px;
    }
    
    .socials {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 15px;
    }
}

/* celulares - hasta 480px */
@media (max-width: 480px) {
    .footer-container {
        padding: 20px 15px 30px;
        gap: 30px;
    }
    
    .subscribe-section h4 {
        font-size: 16px;
    }
    
    .subscribe-form input {
        max-width: 280px;
        font-size: 13px;
        padding: 10px;
    }
    
    .subscribe-form button {
        max-width: 280px;
        padding: 10px;
        font-size: 13px;
    }
    
    .subscribe-section label {
        font-size: 11px;
    }
    
    .footer-links {
        flex-direction: column;
        gap: 25px;
    }
    
    .footer-links > div {
        flex: none;
        min-width: auto;
        width: 100%;
    }
    
    .footer-links div h5 {
        font-size: 15px;
        margin-bottom: 8px;
    }
    
    .footer-links ul li {
        font-size: 13px;
        margin-bottom: 4px;
    }
    
    .footer-links p {
        font-size: 13px;
        margin: 5px 0;
    }
    
    .socials {
        margin-top: 15px;
        gap: 12px;
    }
    
    .socials a {
        padding: 8px 10px;
        font-size: 1.1rem;
    }
    
    .footer-bottom {
        padding: 15px 0;
        font-size: 11px;
    }
}

/* celus muy pequeños - hasta 320px */
@media (max-width: 320px) {
    .footer-container {
        padding: 15px 10px 25px;
        gap: 25px;
    }
    
    .subscribe-section h4 {
        font-size: 15px;
    }
    
    .subscribe-form input,
    .subscribe-form button {
        max-width: 250px;
        font-size: 12px;
        padding: 8px;
    }
    
    .subscribe-section label {
        font-size: 10px;
    }
    
    .footer-links div h5 {
        font-size: 14px;
    }
    
    .footer-links ul li,
    .footer-links p {
        font-size: 12px;
    }
    
    .socials a {
        padding: 6px 8px;
        font-size: 1rem;
    }
    
    .footer-bottom {
        font-size: 10px;
    }
}

@media (max-width: 768px) {
    .subscribe-form input:hover,
    .subscribe-form input:focus {
        box-shadow: 0 0 0 2px skyblue;
    }
    
    .subscribe-form button:hover {
        background-color: #666;
    }
    
    .footer-links ul li a:hover {
        color: #ccc;
    }
    
    
    .footer-links svg {
        max-width: 100px;
        height: auto;
    }
}
</style>