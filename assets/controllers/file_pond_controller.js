import {Controller} from "@hotwired/stimulus";
import * as FilePond from 'filepond';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode'
import 'filepond/dist/filepond.min.css'


// Register Plugins
FilePond.registerPlugin(
    FilePondPluginFileEncode,
)


/* stimulusFetch: 'lazy' */
export default class extends Controller {


    static targets = ["input"];


    connect() {


        if (this.inputTarget) {

            // Initialization
            this.fp = FilePond.create(this.inputTarget, {
                storeAsFile: true,
            });

            this.fp.on("init", (event) => {
                console.log("FilePond:init")

                // (1) workaround hide originally rendered field via file-pond controller when filepond is initialized
                this.fp.element.classList.remove('hidden')

            });


            // 'addfile' instead of 'FilePond:addfile'
            this.fp.on('addfile', (error, file) => {
                if (error) {
                    console.log('Oh no');
                    return;
                }

                console.log('File added', file.getFileEncodeDataURL());
            })

        }

    }


}