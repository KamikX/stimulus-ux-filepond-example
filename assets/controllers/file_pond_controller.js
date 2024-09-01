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
                // workaround hide originally rendered field via class in twig, classes are cloned to new filepond element, must be removed when filepond is initialized
                this.fp.element.classList.remove('hidden')

            });


            // 'addfile' instead of 'FilePond:addfile'
            this.fp.on('addfile', (error, file) => {


                // Experiment with ID (not working)
                // id = post_form_file
                // name = post_form[file]

                //<input type="file" id="post_form_file" name="post_form[file]" required="required" data-file-pond-target="input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                //<input type="file" name="post_form[file]" id="post_form_file">
                // const fileInputs = this.element.parentElement.querySelectorAll("form input[type='file']");
                //
                // let fieldId = null;
                // fileInputs.forEach(fileInput => {
                //     if (fileInput.hasAttribute('data-file-pond-target')) {
                //         fieldId = fileInput.id
                //         fileInput.remove()
                //     }
                //
                //     if (!fileInput.hasAttribute('id')) {
                //         fileInput.setAttribute('id', fieldId);
                //     }
                //
                // })


                console.log(this.element.parentElement.querySelectorAll("form input[type='file']"));

            })

        }

    }


}