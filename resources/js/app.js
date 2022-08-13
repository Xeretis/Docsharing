require("./bootstrap");

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

const bodyScrollLock = require("body-scroll-lock");
window.bodyScrollLock = bodyScrollLock;
