import { Datepicker } from "vanillajs-datepicker"
import "vanillajs-datepicker/css/datepicker-bs5.css"

//<input type="text" name="datepick">

const elem = document.querySelector('input[name="datepick"]');
const datepicker = new Datepicker(elem, {
  buttonClass: 'btn',
}); 