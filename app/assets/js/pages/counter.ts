import '@sass/pages/counter.scss'
import {HttpMethod, HttpUtils} from "@ts/http_utils";

class Counter{
    private readonly _counter = document.getElementById('Counter') as HTMLElement;
    private readonly _incrementBtn = document.getElementById('IncrementBtn') as HTMLElement;
    private readonly _loader = document.getElementById('Loader') as HTMLElement;
    private _currentCounterVal = 0;

    constructor() {
        this._currentCounterVal = parseInt(this._counter.innerText, 10);
        this._incrementBtn.addEventListener('click', this._incrementCounter.bind(this));
    }

    private _incrementCounter = async (_event: MouseEvent) => {
        this._loader.classList.add('show');

        let newCounterVal = this._currentCounterVal + 1;

        try{
            await HttpUtils.appFetch(HttpMethod.PUT, 'api/increase_counter', {
                counter_val: newCounterVal
            });

            this._currentCounterVal = newCounterVal;
            this._counter.innerHTML = newCounterVal.toString();

        }catch(error){
            console.log(error);
        }finally{
            this._loader.classList.remove('show');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => new Counter());