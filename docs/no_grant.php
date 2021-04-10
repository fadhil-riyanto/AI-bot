<style>
    *,
    :before,
    :after {
        box-sizing: border-box;
    }

    body {
        display: flex;
        align-items: center;
        background: #E3F2FD;
        min-width: 275px;
        height: 100vh;
        margin: 0 10vw;
        overflow: hidden;
        color: #138FF2;
        font-family: Roboto;
    }

    .wrapper {
        flex-grow: 2;
        width: 40vw;
        max-width: 500px;
        margin: 0 auto;
    }

    h1 {
        margin: 0;
        font-size: 6em;
        font-weight: 100;
    }

    p {
        width: 95%;
        font-size: 1.5em;
        line-height: 1.4;
    }

    .buttons {
        white-space: nowrap;
        display: inline-block;
    }

    span {
        display: block;
        text-transform: uppercase;
        color: #B9DDFB;
        letter-spacing: 1.5px;
        text-align: center;
    }

    a {
        display: inline-block;
        padding: 0.8em 1em;
        margin-right: 1em;
        margin-bottom: 1em;
        border: 3px solid #B9DDFB;
        color: #138FF2;
        font-weight: 500;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 0.2em;
        position: relative;
        overflow: hidden;
        transition: 0.3s;
    }

    a:hover {
        color: #E3F2FD;
    }

    a:hover:before {
        top: 0;
    }

    a:before {
        content: "";
        background: #138FF2;
        height: 100%;
        width: 100%;
        position: absolute;
        top: -100%;
        left: 0;
        transition: 0.3s;
        z-index: -1;
    }

    .space {
        width: 75px;
        height: calc(50vh + 37.5px);
        border-top-left-radius: 37.5px;
        border-top-right-radius: 37.5px;
        overflow: hidden;
        margin: calc(50vh - 37.5px) auto 0 auto;
        position: relative;
        pointer-events: none;
        -webkit-transform: translateZ(0);
    }

    .blackhole {
        border: 5px solid #1674D1;
        height: 75px;
        width: 75px;
        border-radius: 50%;
        position: absolute;
        top: 0;
        left: 0;
    }

    .blackhole:after {
        content: "";
        height: calc(100% + 10px);
        width: calc(100% + 10px);
        border: 5px solid #1674D1;
        border-right-color: transparent;
        border-bottom-color: transparent;
        border-radius: 50%;
        position: absolute;
        top: -5px;
        left: -5px;
        z-index: 5;
        transform: rotate(45deg);
    }

    .ship {
        height: 150px;
        width: 55px;
        margin-left: 10px;
        background: url("https://cbwconline.com/IMG/Codepen/Space%20Ship.svg") center/contain no-repeat;
        animation: blackhole 4s infinite linear;
        position: absolute;
        bottom: -150px;
    }

    @keyframes blackhole {
        to {
            transform: translateY(-100vh);
        }
    }

    @media (max-width: 600px) {
        body {
            margin: 0 5vw;
        }
    }
</style>
<div class="wrapper">
    <h1>Hmm.</h1>
    <p>Maaf, kami tidak bisa menampilkan dashboard API ini kepada anda karna anda belum login. untuk dapat login, anda harus mendapatkan key dari @fadhil_riyanto di telegram untuk autentikasi.</p>
    <div class="buttons"><a href="/docs/auth">Login</a></div>
</div>
<div class="space">
    <div class="blackhole"></div>
    <div class="ship"></div>
</div>