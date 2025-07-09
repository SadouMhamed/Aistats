<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-t8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'AIStats') }} - {{ __('welcome.title') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @if(app()->environment('production') || app()->environment('local'))
    <!-- SOLUTION RENDER: CSS TAILWIND COMPLET INLINE (généré automatiquement) -->
    <style>
        *,:before,:after{--tw-border-spacing-x: 0;--tw-border-spacing-y: 0;--tw-translate-x: 0;--tw-translate-y: 0;--tw-rotate: 0;--tw-skew-x: 0;--tw-skew-y: 0;--tw-scale-x: 1;--tw-scale-y: 1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness: proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: rgb(59 130 246 / .5);--tw-ring-offset-shadow: 0 0 #0000;--tw-ring-shadow: 0 0 #0000;--tw-shadow: 0 0 #0000;--tw-shadow-colored: 0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }::backdrop{--tw-border-spacing-x: 0;--tw-border-spacing-y: 0;--tw-translate-x: 0;--tw-translate-y: 0;--tw-rotate: 0;--tw-skew-x: 0;--tw-skew-y: 0;--tw-scale-x: 1;--tw-scale-y: 1;--tw-pan-x: ;--tw-pan-y: ;--tw-pinch-zoom: ;--tw-scroll-snap-strictness: proximity;--tw-gradient-from-position: ;--tw-gradient-via-position: ;--tw-gradient-to-position: ;--tw-ordinal: ;--tw-slashed-zero: ;--tw-numeric-figure: ;--tw-numeric-spacing: ;--tw-numeric-fraction: ;--tw-ring-inset: ;--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: rgb(59 130 246 / .5);--tw-ring-offset-shadow: 0 0 #0000;--tw-ring-shadow: 0 0 #0000;--tw-shadow: 0 0 #0000;--tw-shadow-colored: 0 0 #0000;--tw-blur: ;--tw-brightness: ;--tw-contrast: ;--tw-grayscale: ;--tw-hue-rotate: ;--tw-invert: ;--tw-saturate: ;--tw-sepia: ;--tw-drop-shadow: ;--tw-backdrop-blur: ;--tw-backdrop-brightness: ;--tw-backdrop-contrast: ;--tw-backdrop-grayscale: ;--tw-backdrop-hue-rotate: ;--tw-backdrop-invert: ;--tw-backdrop-opacity: ;--tw-backdrop-saturate: ;--tw-backdrop-sepia: ;--tw-contain-size: ;--tw-contain-layout: ;--tw-contain-paint: ;--tw-contain-style: }*,:before,:after{box-sizing:border-box;border-width:0;border-style:solid;border-color:#e5e7eb}:before,:after{--tw-content: ""}html,:host{line-height:1.5;-webkit-text-size-adjust:100%;-moz-tab-size:4;-o-tab-size:4;tab-size:4;font-family:Figtree,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji";font-feature-settings:normal;font-variation-settings:normal;-webkit-tap-highlight-color:transparent}body{margin:0;line-height:inherit}hr{height:0;color:inherit;border-top-width:1px}abbr:where([title]){-webkit-text-decoration:underline dotted;text-decoration:underline dotted}h1,h2,h3,h4,h5,h6{font-size:inherit;font-weight:inherit}a{color:inherit;text-decoration:inherit}b,strong{font-weight:bolder}code,kbd,samp,pre{font-family:ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,Courier New,monospace;font-feature-settings:normal;font-variation-settings:normal;font-size:1em}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-.25em}sup{top:-.5em}table{text-indent:0;border-color:inherit;border-collapse:collapse}button,input,optgroup,select,textarea{font-family:inherit;font-feature-settings:inherit;font-variation-settings:inherit;font-size:100%;font-weight:inherit;line-height:inherit;letter-spacing:inherit;color:inherit;margin:0;padding:0}button,select{text-transform:none}button,input:where([type=button]),input:where([type=reset]),input:where([type=submit]){-webkit-appearance:button;background-color:transparent;background-image:none}:-moz-focusring{outline:auto}:-moz-ui-invalid{box-shadow:none}progress{vertical-align:baseline}::-webkit-inner-spin-button,::-webkit-outer-spin-button{height:auto}[type=search]{-webkit-appearance:textfield;outline-offset:-2px}::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}summary{display:list-item}blockquote,dl,dd,h1,h2,h3,h4,h5,h6,hr,figure,p,pre{margin:0}fieldset{margin:0;padding:0}legend{padding:0}ol,ul,menu{list-style:none;margin:0;padding:0}dialog{padding:0}textarea{resize:vertical}input::-moz-placeholder,textarea::-moz-placeholder{opacity:1;color:#9ca3af}input::placeholder,textarea::placeholder{opacity:1;color:#9ca3af}button,[role=button]{cursor:pointer}:disabled{cursor:default}img,svg,video,canvas,audio,iframe,embed,object{display:block;vertical-align:middle}img,video{max-width:100%;height:auto}[hidden]:where(:not([hidden=until-found])){display:none}[type=text],input:where(:not([type])),[type=email],[type=url],[type=password],[type=number],[type=date],[type=datetime-local],[type=month],[type=search],[type=tel],[type=time],[type=week],[multiple],textarea,select{-webkit-appearance:none;-moz-appearance:none;appearance:none;background-color:#fff;border-color:#6b7280;border-width:1px;border-radius:0;padding:.5rem .75rem;font-size:1rem;line-height:1.5rem;--tw-shadow: 0 0 #0000}[type=text]:focus,input:where(:not([type])):focus,[type=email]:focus,[type=url]:focus,[type=password]:focus,[type=number]:focus,[type=date]:focus,[type=datetime-local]:focus,[type=month]:focus,[type=search]:focus,[type=tel]:focus,[type=time]:focus,[type=week]:focus,[multiple]:focus,textarea:focus,select:focus{outline:2px solid transparent;outline-offset:2px;--tw-ring-inset: var(--tw-empty, );--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: #2563eb;--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow);border-color:#2563eb}input::-moz-placeholder,textarea::-moz-placeholder{color:#6b7280;opacity:1}input::placeholder,textarea::placeholder{color:#6b7280;opacity:1}::-webkit-datetime-edit-fields-wrapper{padding:0}::-webkit-date-and-time-value{min-height:1.5em;text-align:inherit}::-webkit-datetime-edit{display:inline-flex}::-webkit-datetime-edit,::-webkit-datetime-edit-year-field,::-webkit-datetime-edit-month-field,::-webkit-datetime-edit-day-field,::-webkit-datetime-edit-hour-field,::-webkit-datetime-edit-minute-field,::-webkit-datetime-edit-second-field,::-webkit-datetime-edit-millisecond-field,::-webkit-datetime-edit-meridiem-field{padding-top:0;padding-bottom:0}select{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");background-position:right .5rem center;background-repeat:no-repeat;background-size:1.5em 1.5em;padding-right:2.5rem;-webkit-print-color-adjust:exact;print-color-adjust:exact}[multiple],[size]:where(select:not([size="1"])){background-image:initial;background-position:initial;background-repeat:unset;background-size:initial;padding-right:.75rem;-webkit-print-color-adjust:unset;print-color-adjust:unset}[type=checkbox],[type=radio]{-webkit-appearance:none;-moz-appearance:none;appearance:none;padding:0;-webkit-print-color-adjust:exact;print-color-adjust:exact;display:inline-block;vertical-align:middle;background-origin:border-box;-webkit-user-select:none;-moz-user-select:none;user-select:none;flex-shrink:0;height:1rem;width:1rem;color:#2563eb;background-color:#fff;border-color:#6b7280;border-width:1px;--tw-shadow: 0 0 #0000}[type=checkbox]{border-radius:0}[type=radio]{border-radius:100%}[type=checkbox]:focus,[type=radio]:focus{outline:2px solid transparent;outline-offset:2px;--tw-ring-inset: var(--tw-empty, );--tw-ring-offset-width: 2px;--tw-ring-offset-color: #fff;--tw-ring-color: #2563eb;--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}[type=checkbox]:checked,[type=radio]:checked{border-color:transparent;background-color:currentColor;background-size:100% 100%;background-position:center;background-repeat:no-repeat}[type=checkbox]:checked{background-image:url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e")}@media (forced-colors: active){[type=checkbox]:checked{-webkit-appearance:auto;-moz-appearance:auto;appearance:auto}}[type=radio]:checked{background-image:url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e")}@media (forced-colors: active){[type=radio]:checked{-webkit-appearance:auto;-moz-appearance:auto;appearance:auto}}[type=checkbox]:checked:hover,[type=checkbox]:checked:focus,[type=radio]:checked:hover,[type=radio]:checked:focus{border-color:transparent;background-color:currentColor}[type=checkbox]:indeterminate{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");border-color:transparent;background-color:currentColor;background-size:100% 100%;background-position:center;background-repeat:no-repeat}@media (forced-colors: active){[type=checkbox]:indeterminate{-webkit-appearance:auto;-moz-appearance:auto;appearance:auto}}[type=checkbox]:indeterminate:hover,[type=checkbox]:indeterminate:focus{border-color:transparent;background-color:currentColor}[type=file]{background:unset;border-color:inherit;border-width:0;border-radius:0;padding:0;font-size:unset;line-height:inherit}[type=file]:focus{outline:1px solid ButtonText;outline:1px auto -webkit-focus-ring-color}.container{width:100%}@media (min-width: 640px){.container{max-width:640px}}@media (min-width: 768px){.container{max-width:768px}}@media (min-width: 1024px){.container{max-width:1024px}}@media (min-width: 1280px){.container{max-width:1280px}}@media (min-width: 1536px){.container{max-width:1536px}}.form-input,.form-textarea,.form-select,.form-multiselect{-webkit-appearance:none;-moz-appearance:none;appearance:none;background-color:#fff;border-color:#6b7280;border-width:1px;border-radius:0;padding:.5rem .75rem;font-size:1rem;line-height:1.5rem;--tw-shadow: 0 0 #0000}.form-input:focus,.form-textarea:focus,.form-select:focus,.form-multiselect:focus{outline:2px solid transparent;outline-offset:2px;--tw-ring-inset: var(--tw-empty, );--tw-ring-offset-width: 0px;--tw-ring-offset-color: #fff;--tw-ring-color: #2563eb;--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow);border-color:#2563eb}.form-input::-moz-placeholder,.form-textarea::-moz-placeholder{color:#6b7280;opacity:1}.form-input::placeholder,.form-textarea::placeholder{color:#6b7280;opacity:1}.form-input::-webkit-datetime-edit-fields-wrapper{padding:0}.form-input::-webkit-date-and-time-value{min-height:1.5em;text-align:inherit}.form-input::-webkit-datetime-edit{display:inline-flex}.form-input::-webkit-datetime-edit,.form-input::-webkit-datetime-edit-year-field,.form-input::-webkit-datetime-edit-month-field,.form-input::-webkit-datetime-edit-day-field,.form-input::-webkit-datetime-edit-hour-field,.form-input::-webkit-datetime-edit-minute-field,.form-input::-webkit-datetime-edit-second-field,.form-input::-webkit-datetime-edit-millisecond-field,.form-input::-webkit-datetime-edit-meridiem-field{padding-top:0;padding-bottom:0}.form-checkbox,.form-radio{-webkit-appearance:none;-moz-appearance:none;appearance:none;padding:0;-webkit-print-color-adjust:exact;print-color-adjust:exact;display:inline-block;vertical-align:middle;background-origin:border-box;-webkit-user-select:none;-moz-user-select:none;user-select:none;flex-shrink:0;height:1rem;width:1rem;color:#2563eb;background-color:#fff;border-color:#6b7280;border-width:1px;--tw-shadow: 0 0 #0000}.form-checkbox{border-radius:0}.form-radio{border-radius:100%}.form-checkbox:focus,.form-radio:focus{outline:2px solid transparent;outline-offset:2px;--tw-ring-inset: var(--tw-empty, );--tw-ring-offset-width: 2px;--tw-ring-offset-color: #fff;--tw-ring-color: #2563eb;--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow)}.form-checkbox:checked,.form-radio:checked{border-color:transparent;background-color:currentColor;background-size:100% 100%;background-position:center;background-repeat:no-repeat}.form-checkbox:checked{background-image:url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e")}@media (forced-colors: active){.form-checkbox:checked{-webkit-appearance:auto;-moz-appearance:auto;appearance:auto}}.form-radio:checked{background-image:url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e")}@media (forced-colors: active){.form-radio:checked{-webkit-appearance:auto;-moz-appearance:auto;appearance:auto}}.form-checkbox:checked:hover,.form-checkbox:checked:focus,.form-radio:checked:hover,.form-radio:checked:focus{border-color:transparent;background-color:currentColor}.form-checkbox:indeterminate{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e");border-color:transparent;background-color:currentColor;background-size:100% 100%;background-position:center;background-repeat:no-repeat}@media (forced-colors: active){.form-checkbox:indeterminate{-webkit-appearance:auto;-moz-appearance:auto;appearance:auto}}.form-checkbox:indeterminate:hover,.form-checkbox:indeterminate:focus{border-color:transparent;background-color:currentColor}.sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border-width:0}.visible{visibility:visible}.collapse{visibility:collapse}.fixed{position:fixed}.absolute{position:absolute}.relative{position:relative}.inset-0{top:0;right:0;bottom:0;left:0}.inset-x-0{left:0;right:0}.end-0{inset-inline-end:0px}.left-0{left:0}.start-0{inset-inline-start:0px}.top-0{top:0}.isolate{isolation:isolate}.z-0{z-index:0}.z-50{z-index:50}.-m-1\.5{margin:-.375rem}.m-2{margin:.5rem}.m-4{margin:1rem}.mx-auto{margin-left:auto;margin-right:auto}.-me-2{margin-inline-end:-.5rem}.-ml-px{margin-left:-1px}.mb-2{margin-bottom:.5rem}.mb-3{margin-bottom:.75rem}.mb-4{margin-bottom:1rem}.mb-6{margin-bottom:1.5rem}.mb-8{margin-bottom:2rem}.ml-1{margin-left:.25rem}.ml-2{margin-left:.5rem}.ml-3{margin-left:.75rem}.ml-4{margin-left:1rem}.mr-2{margin-right:.5rem}.mr-3{margin-right:.75rem}.mr-4{margin-right:1rem}.ms-1{margin-inline-start:.25rem}.ms-2{margin-inline-start:.5rem}.ms-3{margin-inline-start:.75rem}.ms-4{margin-inline-start:1rem}.mt-1{margin-top:.25rem}.mt-10{margin-top:2.5rem}.mt-16{margin-top:4rem}.mt-2{margin-top:.5rem}.mt-20{margin-top:5rem}.mt-24{margin-top:6rem}.mt-3{margin-top:.75rem}.mt-4{margin-top:1rem}.mt-6{margin-top:1.5rem}.mt-8{margin-top:2rem}.block{display:block}.inline-block{display:inline-block}.inline{display:inline}.flex{display:flex}.inline-flex{display:inline-flex}.table{display:table}.grid{display:grid}.hidden{display:none}.h-10{height:2.5rem}.h-12{height:3rem}.h-16{height:4rem}.h-20{height:5rem}.h-4{height:1rem}.h-5{height:1.25rem}.h-6{height:1.5rem}.h-8{height:2rem}.h-9{height:2.25rem}.min-h-screen{min-height:100vh}.w-10{width:2.5rem}.w-12{width:3rem}.w-16{width:4rem}.w-20{width:5rem}.w-3\/4{width:75%}.w-4{width:1rem}.w-48{width:12rem}.w-5{width:1.25rem}.w-6{width:1.5rem}.w-8{width:2rem}.w-auto{width:auto}.w-full{width:100%}.min-w-full{min-width:100%}.max-w-2xl{max-width:42rem}.max-w-3xl{max-width:48rem}.max-w-4xl{max-width:56rem}.max-w-7xl{max-width:80rem}.max-w-lg{max-width:32rem}.max-w-md{max-width:28rem}.max-w-none{max-width:none}.max-w-sm{max-width:24rem}.max-w-xl{max-width:36rem}.flex-1{flex:1 1 0%}.flex-none{flex:none}.flex-shrink-0,.shrink-0{flex-shrink:0}.border-collapse{border-collapse:collapse}.origin-top{transform-origin:top}.translate-y-0{--tw-translate-y: 0px;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.translate-y-4{--tw-translate-y: 1rem;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.scale-100{--tw-scale-x: 1;--tw-scale-y: 1;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.scale-95{--tw-scale-x: .95;--tw-scale-y: .95;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.transform{transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.cursor-default{cursor:default}.cursor-not-allowed{cursor:not-allowed}.cursor-pointer{cursor:pointer}.list-inside{list-style-position:inside}.list-disc{list-style-type:disc}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}.grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.flex-row{flex-direction:row}.flex-col{flex-direction:column}.flex-wrap{flex-wrap:wrap}.items-start{align-items:flex-start}.items-center{align-items:center}.justify-start{justify-content:flex-start}.justify-end{justify-content:flex-end}.justify-center{justify-content:center}.justify-between{justify-content:space-between}.justify-items-center{justify-items:center}.gap-2{gap:.5rem}.gap-4{gap:1rem}.gap-6{gap:1.5rem}.gap-8{gap:2rem}.gap-x-3{-moz-column-gap:.75rem;column-gap:.75rem}.gap-x-6{-moz-column-gap:1.5rem;column-gap:1.5rem}.gap-x-8{-moz-column-gap:2rem;column-gap:2rem}.gap-y-10{row-gap:2.5rem}.gap-y-16{row-gap:4rem}.space-x-2>:not([hidden])~:not([hidden]){--tw-space-x-reverse: 0;margin-right:calc(.5rem * var(--tw-space-x-reverse));margin-left:calc(.5rem * calc(1 - var(--tw-space-x-reverse)))}.space-x-3>:not([hidden])~:not([hidden]){--tw-space-x-reverse: 0;margin-right:calc(.75rem * var(--tw-space-x-reverse));margin-left:calc(.75rem * calc(1 - var(--tw-space-x-reverse)))}.space-x-4>:not([hidden])~:not([hidden]){--tw-space-x-reverse: 0;margin-right:calc(1rem * var(--tw-space-x-reverse));margin-left:calc(1rem * calc(1 - var(--tw-space-x-reverse)))}.space-x-8>:not([hidden])~:not([hidden]){--tw-space-x-reverse: 0;margin-right:calc(2rem * var(--tw-space-x-reverse));margin-left:calc(2rem * calc(1 - var(--tw-space-x-reverse)))}.space-y-1>:not([hidden])~:not([hidden]){--tw-space-y-reverse: 0;margin-top:calc(.25rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(.25rem * var(--tw-space-y-reverse))}.space-y-2>:not([hidden])~:not([hidden]){--tw-space-y-reverse: 0;margin-top:calc(.5rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(.5rem * var(--tw-space-y-reverse))}.space-y-3>:not([hidden])~:not([hidden]){--tw-space-y-reverse: 0;margin-top:calc(.75rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(.75rem * var(--tw-space-y-reverse))}.space-y-4>:not([hidden])~:not([hidden]){--tw-space-y-reverse: 0;margin-top:calc(1rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1rem * var(--tw-space-y-reverse))}.space-y-6>:not([hidden])~:not([hidden]){--tw-space-y-reverse: 0;margin-top:calc(1.5rem * calc(1 - var(--tw-space-y-reverse)));margin-bottom:calc(1.5rem * var(--tw-space-y-reverse))}.divide-y>:not([hidden])~:not([hidden]){--tw-divide-y-reverse: 0;border-top-width:calc(1px * calc(1 - var(--tw-divide-y-reverse)));border-bottom-width:calc(1px * var(--tw-divide-y-reverse))}.divide-gray-200>:not([hidden])~:not([hidden]){--tw-divide-opacity: 1;border-color:rgb(229 231 235 / var(--tw-divide-opacity, 1))}.overflow-hidden{overflow:hidden}.overflow-x-auto{overflow-x:auto}.overflow-y-auto{overflow-y:auto}.overflow-y-hidden{overflow-y:hidden}.whitespace-nowrap{white-space:nowrap}.rounded{border-radius:.25rem}.rounded-3xl{border-radius:1.5rem}.rounded-full{border-radius:9999px}.rounded-lg{border-radius:.5rem}.rounded-md{border-radius:.375rem}.rounded-b-lg{border-bottom-right-radius:.5rem;border-bottom-left-radius:.5rem}.rounded-l-md{border-top-left-radius:.375rem;border-bottom-left-radius:.375rem}.rounded-r-md{border-top-right-radius:.375rem;border-bottom-right-radius:.375rem}.border{border-width:1px}.border-2{border-width:2px}.border-b{border-bottom-width:1px}.border-b-2{border-bottom-width:2px}.border-l-4{border-left-width:4px}.border-t{border-top-width:1px}.border-dashed{border-style:dashed}.border-blue-200{--tw-border-opacity: 1;border-color:rgb(191 219 254 / var(--tw-border-opacity, 1))}.border-gray-100{--tw-border-opacity: 1;border-color:rgb(243 244 246 / var(--tw-border-opacity, 1))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity, 1))}.border-gray-300{--tw-border-opacity: 1;border-color:rgb(209 213 219 / var(--tw-border-opacity, 1))}.border-green-300{--tw-border-opacity: 1;border-color:rgb(134 239 172 / var(--tw-border-opacity, 1))}.border-green-400{--tw-border-opacity: 1;border-color:rgb(74 222 128 / var(--tw-border-opacity, 1))}.border-green-500{--tw-border-opacity: 1;border-color:rgb(34 197 94 / var(--tw-border-opacity, 1))}.border-indigo-400{--tw-border-opacity: 1;border-color:rgb(129 140 248 / var(--tw-border-opacity, 1))}.border-orange-400{--tw-border-opacity: 1;border-color:rgb(251 146 60 / var(--tw-border-opacity, 1))}.border-purple-300{--tw-border-opacity: 1;border-color:rgb(216 180 254 / var(--tw-border-opacity, 1))}.border-red-300{--tw-border-opacity: 1;border-color:rgb(252 165 165 / var(--tw-border-opacity, 1))}.border-red-400{--tw-border-opacity: 1;border-color:rgb(248 113 113 / var(--tw-border-opacity, 1))}.border-transparent{border-color:transparent}.border-white\/10{border-color:#ffffff1a}.border-yellow-300{--tw-border-opacity: 1;border-color:rgb(253 224 71 / var(--tw-border-opacity, 1))}.border-yellow-400{--tw-border-opacity: 1;border-color:rgb(250 204 21 / var(--tw-border-opacity, 1))}.bg-blue-100{--tw-bg-opacity: 1;background-color:rgb(219 234 254 / var(--tw-bg-opacity, 1))}.bg-blue-400{--tw-bg-opacity: 1;background-color:rgb(96 165 250 / var(--tw-bg-opacity, 1))}.bg-blue-50{--tw-bg-opacity: 1;background-color:rgb(239 246 255 / var(--tw-bg-opacity, 1))}.bg-blue-500{--tw-bg-opacity: 1;background-color:rgb(59 130 246 / var(--tw-bg-opacity, 1))}.bg-blue-600{--tw-bg-opacity: 1;background-color:rgb(37 99 235 / var(--tw-bg-opacity, 1))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity, 1))}.bg-gray-200{--tw-bg-opacity: 1;background-color:rgb(229 231 235 / var(--tw-bg-opacity, 1))}.bg-gray-300{--tw-bg-opacity: 1;background-color:rgb(209 213 219 / var(--tw-bg-opacity, 1))}.bg-gray-50{--tw-bg-opacity: 1;background-color:rgb(249 250 251 / var(--tw-bg-opacity, 1))}.bg-gray-500{--tw-bg-opacity: 1;background-color:rgb(107 114 128 / var(--tw-bg-opacity, 1))}.bg-gray-600{--tw-bg-opacity: 1;background-color:rgb(75 85 99 / var(--tw-bg-opacity, 1))}.bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity, 1))}.bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity, 1))}.bg-green-100{--tw-bg-opacity: 1;background-color:rgb(220 252 231 / var(--tw-bg-opacity, 1))}.bg-green-400{--tw-bg-opacity: 1;background-color:rgb(74 222 128 / var(--tw-bg-opacity, 1))}.bg-green-50{--tw-bg-opacity: 1;background-color:rgb(240 253 244 / var(--tw-bg-opacity, 1))}.bg-green-500{--tw-bg-opacity: 1;background-color:rgb(34 197 94 / var(--tw-bg-opacity, 1))}.bg-green-600{--tw-bg-opacity: 1;background-color:rgb(22 163 74 / var(--tw-bg-opacity, 1))}.bg-indigo-100{--tw-bg-opacity: 1;background-color:rgb(224 231 255 / var(--tw-bg-opacity, 1))}.bg-indigo-50{--tw-bg-opacity: 1;background-color:rgb(238 242 255 / var(--tw-bg-opacity, 1))}.bg-indigo-600{--tw-bg-opacity: 1;background-color:rgb(79 70 229 / var(--tw-bg-opacity, 1))}.bg-orange-100{--tw-bg-opacity: 1;background-color:rgb(255 237 213 / var(--tw-bg-opacity, 1))}.bg-purple-100{--tw-bg-opacity: 1;background-color:rgb(243 232 255 / var(--tw-bg-opacity, 1))}.bg-purple-50{--tw-bg-opacity: 1;background-color:rgb(250 245 255 / var(--tw-bg-opacity, 1))}.bg-purple-600{--tw-bg-opacity: 1;background-color:rgb(147 51 234 / var(--tw-bg-opacity, 1))}.bg-red-100{--tw-bg-opacity: 1;background-color:rgb(254 226 226 / var(--tw-bg-opacity, 1))}.bg-red-600{--tw-bg-opacity: 1;background-color:rgb(220 38 38 / var(--tw-bg-opacity, 1))}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity, 1))}.bg-white\/10{background-color:#ffffff1a}.bg-white\/5{background-color:#ffffff0d}.bg-yellow-100{--tw-bg-opacity: 1;background-color:rgb(254 249 195 / var(--tw-bg-opacity, 1))}.bg-yellow-50{--tw-bg-opacity: 1;background-color:rgb(254 252 232 / var(--tw-bg-opacity, 1))}.bg-yellow-600{--tw-bg-opacity: 1;background-color:rgb(202 138 4 / var(--tw-bg-opacity, 1))}.bg-gradient-to-r{background-image:linear-gradient(to right,var(--tw-gradient-stops))}.from-blue-600{--tw-gradient-from: #2563eb var(--tw-gradient-from-position);--tw-gradient-to: rgb(37 99 235 / 0) var(--tw-gradient-to-position);--tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)}.to-indigo-600{--tw-gradient-to: #4f46e5 var(--tw-gradient-to-position)}.fill-current{fill:currentColor}.p-1{padding:.25rem}.p-1\.5{padding:.375rem}.p-10{padding:2.5rem}.p-2{padding:.5rem}.p-3{padding:.75rem}.p-4{padding:1rem}.p-6{padding:1.5rem}.p-8{padding:2rem}.px-1{padding-left:.25rem;padding-right:.25rem}.px-2{padding-left:.5rem;padding-right:.5rem}.px-2\.5{padding-left:.625rem;padding-right:.625rem}.px-3{padding-left:.75rem;padding-right:.75rem}.px-3\.5{padding-left:.875rem;padding-right:.875rem}.px-4{padding-left:1rem;padding-right:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.px-8{padding-left:2rem;padding-right:2rem}.py-0\.5{padding-top:.125rem;padding-bottom:.125rem}.py-1{padding-top:.25rem;padding-bottom:.25rem}.py-1\.5{padding-top:.375rem;padding-bottom:.375rem}.py-12{padding-top:3rem;padding-bottom:3rem}.py-2{padding-top:.5rem;padding-bottom:.5rem}.py-2\.5{padding-top:.625rem;padding-bottom:.625rem}.py-24{padding-top:6rem;padding-bottom:6rem}.py-3{padding-top:.75rem;padding-bottom:.75rem}.py-32{padding-top:8rem;padding-bottom:8rem}.py-4{padding-top:1rem;padding-bottom:1rem}.py-48{padding-top:12rem;padding-bottom:12rem}.py-56{padding-top:14rem;padding-bottom:14rem}.py-6{padding-top:1.5rem;padding-bottom:1.5rem}.py-8{padding-top:2rem;padding-bottom:2rem}.pb-1{padding-bottom:.25rem}.pb-3{padding-bottom:.75rem}.pb-4{padding-bottom:1rem}.pb-6{padding-bottom:1.5rem}.pb-8{padding-bottom:2rem}.pe-4{padding-inline-end:1rem}.pl-1{padding-left:.25rem}.pl-16{padding-left:4rem}.pl-3{padding-left:.75rem}.pr-10{padding-right:2.5rem}.ps-3{padding-inline-start:.75rem}.pt-1{padding-top:.25rem}.pt-14{padding-top:3.5rem}.pt-16{padding-top:4rem}.pt-2{padding-top:.5rem}.pt-32{padding-top:8rem}.pt-4{padding-top:1rem}.pt-5{padding-top:1.25rem}.pt-6{padding-top:1.5rem}.pt-8{padding-top:2rem}.text-left{text-align:left}.text-center{text-align:center}.text-right{text-align:right}.text-start{text-align:start}.font-sans{font-family:Figtree,ui-sans-serif,system-ui,sans-serif,"Apple Color Emoji","Segoe UI Emoji",Segoe UI Symbol,"Noto Color Emoji"}.text-2xl{font-size:1.5rem;line-height:2rem}.text-3xl{font-size:1.875rem;line-height:2.25rem}.text-4xl{font-size:2.25rem;line-height:2.5rem}.text-6xl{font-size:3.75rem;line-height:1}.text-8xl{font-size:6rem;line-height:1}.text-base{font-size:1rem;line-height:1.5rem}.text-lg{font-size:1.125rem;line-height:1.75rem}.text-sm{font-size:.875rem;line-height:1.25rem}.text-xl{font-size:1.25rem;line-height:1.75rem}.text-xs{font-size:.75rem;line-height:1rem}.font-bold{font-weight:700}.font-medium{font-weight:500}.font-semibold{font-weight:600}.uppercase{text-transform:uppercase}.italic{font-style:italic}.leading-4{line-height:1rem}.leading-5{line-height:1.25rem}.leading-6{line-height:1.5rem}.leading-7{line-height:1.75rem}.leading-8{line-height:2rem}.leading-relaxed{line-height:1.625}.leading-tight{line-height:1.25}.tracking-tight{letter-spacing:-.025em}.tracking-wide{letter-spacing:.025em}.tracking-wider{letter-spacing:.05em}.tracking-widest{letter-spacing:.1em}.text-blue-400{--tw-text-opacity: 1;color:rgb(96 165 250 / var(--tw-text-opacity, 1))}.text-blue-600{--tw-text-opacity: 1;color:rgb(37 99 235 / var(--tw-text-opacity, 1))}.text-blue-700{--tw-text-opacity: 1;color:rgb(29 78 216 / var(--tw-text-opacity, 1))}.text-blue-800{--tw-text-opacity: 1;color:rgb(30 64 175 / var(--tw-text-opacity, 1))}.text-blue-900{--tw-text-opacity: 1;color:rgb(30 58 138 / var(--tw-text-opacity, 1))}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity, 1))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity, 1))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity, 1))}.text-gray-800{--tw-text-opacity: 1;color:rgb(31 41 55 / var(--tw-text-opacity, 1))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity, 1))}.text-green-400{--tw-text-opacity: 1;color:rgb(74 222 128 / var(--tw-text-opacity, 1))}.text-green-600{--tw-text-opacity: 1;color:rgb(22 163 74 / var(--tw-text-opacity, 1))}.text-green-700{--tw-text-opacity: 1;color:rgb(21 128 61 / var(--tw-text-opacity, 1))}.text-green-800{--tw-text-opacity: 1;color:rgb(22 101 52 / var(--tw-text-opacity, 1))}.text-indigo-600{--tw-text-opacity: 1;color:rgb(79 70 229 / var(--tw-text-opacity, 1))}.text-indigo-700{--tw-text-opacity: 1;color:rgb(67 56 202 / var(--tw-text-opacity, 1))}.text-orange-600{--tw-text-opacity: 1;color:rgb(234 88 12 / var(--tw-text-opacity, 1))}.text-orange-700{--tw-text-opacity: 1;color:rgb(194 65 12 / var(--tw-text-opacity, 1))}.text-orange-800{--tw-text-opacity: 1;color:rgb(154 52 18 / var(--tw-text-opacity, 1))}.text-purple-600{--tw-text-opacity: 1;color:rgb(147 51 234 / var(--tw-text-opacity, 1))}.text-purple-800{--tw-text-opacity: 1;color:rgb(107 33 168 / var(--tw-text-opacity, 1))}.text-red-600{--tw-text-opacity: 1;color:rgb(220 38 38 / var(--tw-text-opacity, 1))}.text-red-700{--tw-text-opacity: 1;color:rgb(185 28 28 / var(--tw-text-opacity, 1))}.text-red-800{--tw-text-opacity: 1;color:rgb(153 27 27 / var(--tw-text-opacity, 1))}.text-teal-600{--tw-text-opacity: 1;color:rgb(13 148 136 / var(--tw-text-opacity, 1))}.text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity, 1))}.text-yellow-600{--tw-text-opacity: 1;color:rgb(202 138 4 / var(--tw-text-opacity, 1))}.text-yellow-700{--tw-text-opacity: 1;color:rgb(161 98 7 / var(--tw-text-opacity, 1))}.text-yellow-800{--tw-text-opacity: 1;color:rgb(133 77 14 / var(--tw-text-opacity, 1))}.underline{text-decoration-line:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.opacity-0{opacity:0}.opacity-100{opacity:1}.opacity-50{opacity:.5}.opacity-75{opacity:.75}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.shadow-lg{--tw-shadow: 0 10px 15px -3px rgb(0 0 0 / .1), 0 4px 6px -4px rgb(0 0 0 / .1);--tw-shadow-colored: 0 10px 15px -3px var(--tw-shadow-color), 0 4px 6px -4px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.shadow-md{--tw-shadow: 0 4px 6px -1px rgb(0 0 0 / .1), 0 2px 4px -2px rgb(0 0 0 / .1);--tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.shadow-sm{--tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);--tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.shadow-xl{--tw-shadow: 0 20px 25px -5px rgb(0 0 0 / .1), 0 8px 10px -6px rgb(0 0 0 / .1);--tw-shadow-colored: 0 20px 25px -5px var(--tw-shadow-color), 0 8px 10px -6px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.outline{outline-style:solid}.ring-1{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.ring-2{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.ring-black{--tw-ring-opacity: 1;--tw-ring-color: rgb(0 0 0 / var(--tw-ring-opacity, 1))}.ring-blue-500{--tw-ring-opacity: 1;--tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity, 1))}.ring-gray-300{--tw-ring-opacity: 1;--tw-ring-color: rgb(209 213 219 / var(--tw-ring-opacity, 1))}.ring-white\/10{--tw-ring-color: rgb(255 255 255 / .1)}.ring-opacity-5{--tw-ring-opacity: .05}.filter{filter:var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow)}.transition{transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,-webkit-backdrop-filter;transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter;transition-property:color,background-color,border-color,text-decoration-color,fill,stroke,opacity,box-shadow,transform,filter,backdrop-filter,-webkit-backdrop-filter;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}.transition-all{transition-property:all;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}.transition-colors{transition-property:color,background-color,border-color,text-decoration-color,fill,stroke;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}.transition-shadow{transition-property:box-shadow;transition-timing-function:cubic-bezier(.4,0,.2,1);transition-duration:.15s}.duration-150{transition-duration:.15s}.duration-200{transition-duration:.2s}.duration-300{transition-duration:.3s}.duration-75{transition-duration:75ms}.ease-in{transition-timing-function:cubic-bezier(.4,0,1,1)}.ease-in-out{transition-timing-function:cubic-bezier(.4,0,.2,1)}.ease-out{transition-timing-function:cubic-bezier(0,0,.2,1)}.file\:mr-4::file-selector-button{margin-right:1rem}.file\:rounded-full::file-selector-button{border-radius:9999px}.file\:border-0::file-selector-button{border-width:0px}.file\:bg-indigo-50::file-selector-button{--tw-bg-opacity: 1;background-color:rgb(238 242 255 / var(--tw-bg-opacity, 1))}.file\:px-4::file-selector-button{padding-left:1rem;padding-right:1rem}.file\:py-2::file-selector-button{padding-top:.5rem;padding-bottom:.5rem}.file\:text-sm::file-selector-button{font-size:.875rem;line-height:1.25rem}.file\:font-semibold::file-selector-button{font-weight:600}.file\:text-indigo-700::file-selector-button{--tw-text-opacity: 1;color:rgb(67 56 202 / var(--tw-text-opacity, 1))}.last\:border-b-0:last-child{border-bottom-width:0px}.focus-within\:outline-none:focus-within{outline:2px solid transparent;outline-offset:2px}.focus-within\:ring-2:focus-within{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.focus-within\:ring-blue-500:focus-within{--tw-ring-opacity: 1;--tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity, 1))}.focus-within\:ring-offset-2:focus-within{--tw-ring-offset-width: 2px}.hover\:border-gray-300:hover{--tw-border-opacity: 1;border-color:rgb(209 213 219 / var(--tw-border-opacity, 1))}.hover\:border-gray-400:hover{--tw-border-opacity: 1;border-color:rgb(156 163 175 / var(--tw-border-opacity, 1))}.hover\:bg-blue-500:hover{--tw-bg-opacity: 1;background-color:rgb(59 130 246 / var(--tw-bg-opacity, 1))}.hover\:bg-blue-700:hover{--tw-bg-opacity: 1;background-color:rgb(29 78 216 / var(--tw-bg-opacity, 1))}.hover\:bg-gray-100:hover{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity, 1))}.hover\:bg-gray-300:hover{--tw-bg-opacity: 1;background-color:rgb(209 213 219 / var(--tw-bg-opacity, 1))}.hover\:bg-gray-50:hover{--tw-bg-opacity: 1;background-color:rgb(249 250 251 / var(--tw-bg-opacity, 1))}.hover\:bg-gray-700:hover{--tw-bg-opacity: 1;background-color:rgb(55 65 81 / var(--tw-bg-opacity, 1))}.hover\:bg-green-700:hover{--tw-bg-opacity: 1;background-color:rgb(21 128 61 / var(--tw-bg-opacity, 1))}.hover\:bg-indigo-700:hover{--tw-bg-opacity: 1;background-color:rgb(67 56 202 / var(--tw-bg-opacity, 1))}.hover\:bg-purple-700:hover{--tw-bg-opacity: 1;background-color:rgb(126 34 206 / var(--tw-bg-opacity, 1))}.hover\:bg-red-500:hover{--tw-bg-opacity: 1;background-color:rgb(239 68 68 / var(--tw-bg-opacity, 1))}.hover\:bg-red-700:hover{--tw-bg-opacity: 1;background-color:rgb(185 28 28 / var(--tw-bg-opacity, 1))}.hover\:bg-white\/20:hover{background-color:#fff3}.hover\:bg-yellow-700:hover{--tw-bg-opacity: 1;background-color:rgb(161 98 7 / var(--tw-bg-opacity, 1))}.hover\:text-blue-500:hover{--tw-text-opacity: 1;color:rgb(59 130 246 / var(--tw-text-opacity, 1))}.hover\:text-blue-800:hover{--tw-text-opacity: 1;color:rgb(30 64 175 / var(--tw-text-opacity, 1))}.hover\:text-blue-900:hover{--tw-text-opacity: 1;color:rgb(30 58 138 / var(--tw-text-opacity, 1))}.hover\:text-gray-200:hover{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity, 1))}.hover\:text-gray-400:hover{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.hover\:text-gray-500:hover{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.hover\:text-gray-700:hover{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity, 1))}.hover\:text-gray-800:hover{--tw-text-opacity: 1;color:rgb(31 41 55 / var(--tw-text-opacity, 1))}.hover\:text-gray-900:hover{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity, 1))}.hover\:text-green-800:hover{--tw-text-opacity: 1;color:rgb(22 101 52 / var(--tw-text-opacity, 1))}.hover\:text-green-900:hover{--tw-text-opacity: 1;color:rgb(20 83 45 / var(--tw-text-opacity, 1))}.hover\:text-purple-800:hover{--tw-text-opacity: 1;color:rgb(107 33 168 / var(--tw-text-opacity, 1))}.hover\:text-red-800:hover{--tw-text-opacity: 1;color:rgb(153 27 27 / var(--tw-text-opacity, 1))}.hover\:text-red-900:hover{--tw-text-opacity: 1;color:rgb(127 29 29 / var(--tw-text-opacity, 1))}.hover\:text-yellow-900:hover{--tw-text-opacity: 1;color:rgb(113 63 18 / var(--tw-text-opacity, 1))}.hover\:shadow-md:hover{--tw-shadow: 0 4px 6px -1px rgb(0 0 0 / .1), 0 2px 4px -2px rgb(0 0 0 / .1);--tw-shadow-colored: 0 4px 6px -1px var(--tw-shadow-color), 0 2px 4px -2px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.hover\:file\:bg-indigo-100::file-selector-button:hover{--tw-bg-opacity: 1;background-color:rgb(224 231 255 / var(--tw-bg-opacity, 1))}.focus\:z-10:focus{z-index:10}.focus\:border-blue-300:focus{--tw-border-opacity: 1;border-color:rgb(147 197 253 / var(--tw-border-opacity, 1))}.focus\:border-blue-500:focus{--tw-border-opacity: 1;border-color:rgb(59 130 246 / var(--tw-border-opacity, 1))}.focus\:border-gray-300:focus{--tw-border-opacity: 1;border-color:rgb(209 213 219 / var(--tw-border-opacity, 1))}.focus\:border-indigo-500:focus{--tw-border-opacity: 1;border-color:rgb(99 102 241 / var(--tw-border-opacity, 1))}.focus\:border-indigo-700:focus{--tw-border-opacity: 1;border-color:rgb(67 56 202 / var(--tw-border-opacity, 1))}.focus\:bg-blue-700:focus{--tw-bg-opacity: 1;background-color:rgb(29 78 216 / var(--tw-bg-opacity, 1))}.focus\:bg-gray-100:focus{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity, 1))}.focus\:bg-gray-50:focus{--tw-bg-opacity: 1;background-color:rgb(249 250 251 / var(--tw-bg-opacity, 1))}.focus\:bg-gray-700:focus{--tw-bg-opacity: 1;background-color:rgb(55 65 81 / var(--tw-bg-opacity, 1))}.focus\:bg-green-700:focus{--tw-bg-opacity: 1;background-color:rgb(21 128 61 / var(--tw-bg-opacity, 1))}.focus\:bg-indigo-100:focus{--tw-bg-opacity: 1;background-color:rgb(224 231 255 / var(--tw-bg-opacity, 1))}.focus\:bg-purple-700:focus{--tw-bg-opacity: 1;background-color:rgb(126 34 206 / var(--tw-bg-opacity, 1))}.focus\:bg-red-700:focus{--tw-bg-opacity: 1;background-color:rgb(185 28 28 / var(--tw-bg-opacity, 1))}.focus\:bg-yellow-700:focus{--tw-bg-opacity: 1;background-color:rgb(161 98 7 / var(--tw-bg-opacity, 1))}.focus\:text-gray-500:focus{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.focus\:text-gray-700:focus{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity, 1))}.focus\:text-gray-800:focus{--tw-text-opacity: 1;color:rgb(31 41 55 / var(--tw-text-opacity, 1))}.focus\:text-indigo-800:focus{--tw-text-opacity: 1;color:rgb(55 48 163 / var(--tw-text-opacity, 1))}.focus\:outline-none:focus{outline:2px solid transparent;outline-offset:2px}.focus\:ring:focus{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.focus\:ring-2:focus{--tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);--tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);box-shadow:var(--tw-ring-offset-shadow),var(--tw-ring-shadow),var(--tw-shadow, 0 0 #0000)}.focus\:ring-blue-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(59 130 246 / var(--tw-ring-opacity, 1))}.focus\:ring-gray-400:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(156 163 175 / var(--tw-ring-opacity, 1))}.focus\:ring-gray-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(107 114 128 / var(--tw-ring-opacity, 1))}.focus\:ring-green-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(34 197 94 / var(--tw-ring-opacity, 1))}.focus\:ring-indigo-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(99 102 241 / var(--tw-ring-opacity, 1))}.focus\:ring-purple-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(168 85 247 / var(--tw-ring-opacity, 1))}.focus\:ring-red-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(239 68 68 / var(--tw-ring-opacity, 1))}.focus\:ring-yellow-500:focus{--tw-ring-opacity: 1;--tw-ring-color: rgb(234 179 8 / var(--tw-ring-opacity, 1))}.focus\:ring-offset-2:focus{--tw-ring-offset-width: 2px}.focus-visible\:outline:focus-visible{outline-style:solid}.focus-visible\:outline-2:focus-visible{outline-width:2px}.focus-visible\:outline-offset-2:focus-visible{outline-offset:2px}.focus-visible\:outline-blue-600:focus-visible{outline-color:#2563eb}.focus-visible\:outline-white:focus-visible{outline-color:#fff}.active\:bg-blue-900:active{--tw-bg-opacity: 1;background-color:rgb(30 58 138 / var(--tw-bg-opacity, 1))}.active\:bg-gray-100:active{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity, 1))}.active\:bg-gray-900:active{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity, 1))}.active\:bg-green-900:active{--tw-bg-opacity: 1;background-color:rgb(20 83 45 / var(--tw-bg-opacity, 1))}.active\:bg-purple-900:active{--tw-bg-opacity: 1;background-color:rgb(88 28 135 / var(--tw-bg-opacity, 1))}.active\:bg-red-700:active{--tw-bg-opacity: 1;background-color:rgb(185 28 28 / var(--tw-bg-opacity, 1))}.active\:bg-red-900:active{--tw-bg-opacity: 1;background-color:rgb(127 29 29 / var(--tw-bg-opacity, 1))}.active\:bg-yellow-900:active{--tw-bg-opacity: 1;background-color:rgb(113 63 18 / var(--tw-bg-opacity, 1))}.active\:text-gray-500:active{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity, 1))}.active\:text-gray-700:active{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity, 1))}.disabled\:opacity-25:disabled{opacity:.25}@media (min-width: 640px){.sm\:-my-px{margin-top:-1px;margin-bottom:-1px}.sm\:mx-auto{margin-left:auto;margin-right:auto}.sm\:ms-10{margin-inline-start:2.5rem}.sm\:ms-6{margin-inline-start:1.5rem}.sm\:mt-20{margin-top:5rem}.sm\:flex{display:flex}.sm\:hidden{display:none}.sm\:w-full{width:100%}.sm\:max-w-2xl{max-width:42rem}.sm\:max-w-lg{max-width:32rem}.sm\:max-w-md{max-width:28rem}.sm\:max-w-sm{max-width:24rem}.sm\:max-w-xl{max-width:36rem}.sm\:flex-1{flex:1 1 0%}.sm\:translate-y-0{--tw-translate-y: 0px;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.sm\:scale-100{--tw-scale-x: 1;--tw-scale-y: 1;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.sm\:scale-95{--tw-scale-x: .95;--tw-scale-y: .95;transform:translate(var(--tw-translate-x),var(--tw-translate-y)) rotate(var(--tw-rotate)) skew(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))}.sm\:items-center{align-items:center}.sm\:justify-center{justify-content:center}.sm\:justify-between{justify-content:space-between}.sm\:rounded-lg{border-radius:.5rem}.sm\:p-8{padding:2rem}.sm\:px-0{padding-left:0;padding-right:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:py-32{padding-top:8rem;padding-bottom:8rem}.sm\:py-48{padding-top:12rem;padding-bottom:12rem}.sm\:pt-0{padding-top:0}.sm\:pt-24{padding-top:6rem}.sm\:text-4xl{font-size:2.25rem;line-height:2.5rem}.sm\:text-6xl{font-size:3.75rem;line-height:1}.sm\:text-sm{font-size:.875rem;line-height:1.25rem}}@media (min-width: 768px){.md\:mt-0{margin-top:0}.md\:max-w-2xl{max-width:42rem}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.md\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.md\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.md\:grid-cols-5{grid-template-columns:repeat(5,minmax(0,1fr))}.md\:flex-row{flex-direction:row}.md\:items-center{align-items:center}.md\:p-8{padding:2rem}}@media (min-width: 1024px){.lg\:mt-24{margin-top:6rem}.lg\:flex{display:flex}.lg\:max-w-4xl{max-width:56rem}.lg\:max-w-none{max-width:none}.lg\:flex-1{flex:1 1 0%}.lg\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}.lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}.lg\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr))}.lg\:justify-end{justify-content:flex-end}.lg\:gap-y-16{row-gap:4rem}.lg\:px-8{padding-left:2rem;padding-right:2rem}.lg\:py-56{padding-top:14rem;padding-bottom:14rem}.lg\:pt-32{padding-top:8rem}.lg\:text-center{text-align:center}}@media (min-width: 1280px){.xl\:mt-10{margin-top:2.5rem}.xl\:p-10{padding:2.5rem}}.ltr\:origin-top-left:where([dir=ltr],[dir=ltr] *){transform-origin:top left}.ltr\:origin-top-right:where([dir=ltr],[dir=ltr] *){transform-origin:top right}.rtl\:origin-top-left:where([dir=rtl],[dir=rtl] *){transform-origin:top left}.rtl\:origin-top-right:where([dir=rtl],[dir=rtl] *){transform-origin:top right}.rtl\:flex-row-reverse:where([dir=rtl],[dir=rtl] *){flex-direction:row-reverse}@media (prefers-color-scheme: dark){.dark\:border-gray-600{--tw-border-opacity: 1;border-color:rgb(75 85 99 / var(--tw-border-opacity, 1))}.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity, 1))}.dark\:text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity, 1))}.dark\:text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity, 1))}.dark\:hover\:text-gray-300:hover{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}.dark\:focus\:border-blue-700:focus{--tw-border-opacity: 1;border-color:rgb(29 78 216 / var(--tw-border-opacity, 1))}.dark\:focus\:border-blue-800:focus{--tw-border-opacity: 1;border-color:rgb(30 64 175 / var(--tw-border-opacity, 1))}.dark\:active\:bg-gray-700:active{--tw-bg-opacity: 1;background-color:rgb(55 65 81 / var(--tw-bg-opacity, 1))}.dark\:active\:text-gray-300:active{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity, 1))}}
        
        /* RENDER FIX INDICATOR - SUPPRIMÉ */
        
        /* CSS SPÉCIFIQUE POUR FORMULAIRE CONTACT & FOOTER */
        .hover\:text-blue-600:hover{color:#2563eb}
        .hover\:text-pink-600:hover{color:#db2777}
        .hover\:text-gray-300:hover{color:#d1d5db}
        .hover\:text-white:hover{color:#fff}
        .text-pink-600{color:#db2777}
        .border-green-300{border-color:#86efac}
        .border-red-300{border-color:#fca5a5}
        .bg-green-100{background-color:#dcfce7}
        .bg-red-100{background-color:#fee2e2}
        .text-green-700{color:#15803d}
        .text-red-700{color:#b91c1c}
        .focus\:ring-inset:focus{--tw-ring-inset:inset}
        .ring-inset{--tw-ring-inset:inset}
        .xl\:grid{display:grid}
        .xl\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr))}
        .xl\:gap-8{gap:2rem}
        .xl\:col-span-2{grid-column:span 2/span 2}
        .lg\:pl-8{padding-left:2rem}
        .space-y-8>:not([hidden])~:not([hidden]){margin-top:2rem}
        .white-space-pre-wrap{white-space:pre-wrap}
        
        /* CSS SPÉCIFIQUE POUR BOUTON "REJOIGNEZ NOTRE SERVICE" */
        .px-3\.5{padding-left:.875rem;padding-right:.875rem}
        .py-2\.5{padding-top:.625rem;padding-bottom:.625rem}
        .hover\:bg-blue-500:hover{--tw-bg-opacity:1;background-color:rgb(59 130 246/var(--tw-bg-opacity))}
        .focus-visible\:outline:focus-visible{outline:2px solid transparent;outline-offset:2px}
        .focus-visible\:outline-2:focus-visible{outline-width:2px}
        .focus-visible\:outline-offset-2:focus-visible{outline-offset:2px}
        .focus-visible\:outline-blue-600:focus-visible{outline-color:#2563eb}
        
        /* CSS POUR SECTION HERO AVEC NOUVELLE IMAGE DE FOND */
        .hero-bg{background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('{{ asset('images/imagefond.jpeg') }}');background-size:cover;background-position:center}
        
        /* CSS POUR CARTES ET ANIMATIONS */
        .card-hover{transition:transform 0.3s cubic-bezier(0.4,0,0.2,1),box-shadow 0.3s cubic-bezier(0.4,0,0.2,1)}
        .card-hover:hover{transform:translateY(-10px);box-shadow:0 30px 60px rgba(0,0,0,0.15)}
        .glass-effect{backdrop-filter:blur(10px);-webkit-backdrop-filter:blur(10px)}
        
        /* CSS POUR SERVICES À LA CARTE */
        .service-checkbox:checked + .service-label{background-color:#eff6ff;border-color:#3b82f6}
        .service-label:hover{background-color:#f8fafc}
        
        /* CSS RESPONSIVE POUR SECTION ABOUT */
        @media (max-width: 640px){
            .about-card{padding:1.5rem !important;margin-bottom:1.5rem !important}
            .about-title{font-size:2rem !important}
            .about-subtitle{font-size:1.125rem !important}
            .about-description{font-size:1rem !important;padding:1.5rem !important}
        }
        
        /* Styles pour les icônes SVG */
        svg{vertical-align:middle}
        .flex-shrink-0{flex-shrink:0}
        .stroke-width-1\.5{stroke-width:1.5}
        .stroke-linecap-round{stroke-linecap:round}
        .stroke-linejoin-round{stroke-linejoin:round}
        
        /* Styles RTL pour l'arabe */
        [dir="rtl"] .text-left { text-align: right; }
        [dir="rtl"] .text-right { text-align: left; }
        [dir="rtl"] .ml-3 { margin-left: 0; margin-right: 0.75rem; }
        [dir="rtl"] .mr-3 { margin-right: 0; margin-left: 0.75rem; }
        [dir="rtl"] .pl-16 { padding-left: 0; padding-right: 4rem; }
        [dir="rtl"] .lg\\:pl-8 { padding-left: 0; padding-right: 2rem; }
        [dir="rtl"] .space-x-4 > :not([hidden]) ~ :not([hidden]) {
            margin-left: 0;
            margin-right: 1rem;
        }
        [dir="rtl"] .space-x-6 > :not([hidden]) ~ :not([hidden]) {
            margin-left: 0;
            margin-right: 1.5rem;
        }
        
        /* Font pour l'arabe */
        .font-arabic {
            font-family: 'Noto Sans Arabic', 'Amiri', 'Traditional Arabic', serif;
        }
        
        /* Améliorer la lisibilité de l'arabe */
        [lang="ar"], [dir="rtl"] {
            font-family: 'Noto Sans Arabic', 'Amiri', 'Traditional Arabic', serif;
            line-height: 1.7;
        }
    </style>
    
    <!-- JavaScript Alpine.js OBLIGATOIRE pour dropdowns -->
    @vite(['resources/js/app.js'])
@else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif

    <script>
        function obtenirDevis() {
            // Récupérer les services sélectionnés
            const servicesSelectionnes = [];
            const checkboxes = document.querySelectorAll('input[name="services[]"]:checked');
            checkboxes.forEach(checkbox => {
                servicesSelectionnes.push(checkbox.value);
            });

            // Récupérer les autres informations
            const nbIndividus = document.getElementById('nb_individus').value;
            const nbVariables = document.getElementById('nb_variables').value;
            const delais = document.getElementById('delais').value;
            const remarques = document.getElementById('remarques').value;

            // Validation
            if (servicesSelectionnes.length === 0) {
                alert('Veuillez sélectionner au moins un service.');
                return;
            }

            if (!nbVariables) {
                alert('Veuillez indiquer le nombre de variables (champ obligatoire).');
                document.getElementById('nb_variables').focus();
                return;
            }

            if (!delais) {
                alert('Veuillez sélectionner un délai de réalisation (champ obligatoire).');
                document.getElementById('delais').focus();
                return;
            }

            // Créer l'objet avec toutes les données
            const devisData = {
                services: servicesSelectionnes,
                nb_individus: nbIndividus,
                nb_variables: nbVariables,
                delais: delais,
                remarques: remarques
            };

            // Stocker les données dans le localStorage pour les récupérer sur la page d'inscription
            localStorage.setItem('devis_data', JSON.stringify(devisData));

            // Rediriger vers la page d'inscription
            window.location.href = '{{ route("register") }}?devis=1';
        }
    </script>
</head>
<body class="antialiased text-gray-800 bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="absolute inset-x-0 top-0 z-50">
            <nav class="flex justify-between items-center p-6 lg:px-8" aria-label="Global">
                <div class="flex lg:flex-1">
                    <a href="#" class="flex items-center p-1.5 -m-1.5">
                        <x-application-logo class="block w-auto h-9 text-white fill-current"/>
                        <span class="ml-3 text-lg font-bold text-white">{{ config('app.name', 'AIStats') }}</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4 lg:flex lg:flex-1 lg:justify-end">
                    <!-- Language Selector -->
                    <x-language-selector />
                    
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-sm font-semibold leading-6 text-white hover:text-gray-200">{{ __('welcome.login') }} <span aria-hidden="true">&rarr;</span></a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-3.5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('welcome.register') }}</a>
                    @endif
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <div class="isolate relative px-6 pt-14 lg:px-8 hero-bg">
            <div class="py-32 mx-auto max-w-2xl sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">{{ __('welcome.hero_title') }}</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-200">{{ __('welcome.hero_subtitle') }}</p>
                    <div class="flex gap-x-6 justify-center items-center mt-10">
                        <a href="{{ route('register') }}" class="px-3.5 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">{{ __('welcome.hero_cta_primary') }}</a>
                        <a href="#features" class="text-sm font-semibold leading-6 text-white">{{ __('welcome.hero_cta_secondary') }} <span aria-hidden="true">↓</span></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Us Section -->
        <section id="about" style="
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        ">
            <!-- Background pattern -->
            <div style="
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                opacity: 0.1;
                background-image: url('data:image/svg+xml;utf8,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 100 100&quot;><circle cx=&quot;50&quot; cy=&quot;50&quot; r=&quot;2&quot; fill=&quot;white&quot;/></svg>');
                background-size: 20px 20px;
            "></div>
            
            <div style="
                max-width: 1280px;
                margin: 0 auto;
                padding: 0 1.5rem;
                position: relative;
                z-index: 10;
            " class="px-4 sm:px-6 lg:px-8">
                <!-- Main Title -->
                <div style="
                    text-align: center;
                    margin-bottom: 4rem;
                ">
                    <h2 style="
                        font-size: 3rem;
                        font-weight: 800;
                        color: white;
                        margin-bottom: 1.5rem;
                        letter-spacing: -0.025em;
                        text-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                    " class="text-2xl sm:text-3xl lg:text-5xl">{{ __('welcome.about_us_title') }}</h2>
                    
                    <div style="
                        background: rgba(255, 255, 255, 0.15);
                        backdrop-filter: blur(10px);
                        border-radius: 20px;
                        padding: 2rem;
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                        max-width: 600px;
                        margin: 0 auto;
                    ">
                        <p class="about-description" style="
                            font-size: 1.5rem;
                            font-weight: 600;
                            color: white;
                            margin: 0;
                            line-height: 1.6;
                        ">{{ __('welcome.about_us_description') }}</p>
                    </div>
                </div>

                <!-- Why Choose Section -->
                <div style="
                    text-align: center;
                    margin-bottom: 4rem;
                ">
                    <h3 class="about-subtitle" style="
                        font-size: 2.25rem;
                        font-weight: 700;
                        color: white;
                        margin-bottom: 1rem;
                        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    ">{{ __('welcome.why_choose_title') }}</h3>
                    <p style="
                        font-size: 1.25rem;
                        color: rgba(255, 255, 255, 0.9);
                        max-width: 600px;
                        margin: 0 auto;
                        line-height: 1.6;
                    ">{{ __('welcome.why_choose_description') }}</p>
                </div>

                <!-- Features Grid -->
                <div style="
                    display: grid;
                    grid-template-columns: 1fr;
                    gap: 2rem;
                    max-width: 1200px;
                    margin: 0 auto;
                " class="lg:grid-cols-2">
                                         <!-- Security Card -->
                    <div class="about-card card-hover glass-effect" style="
                        background: rgba(255, 255, 255, 0.95);
                        border-radius: 24px;
                        padding: 2.5rem;
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        position: relative;
                        overflow: hidden;
                    ">
                        <!-- Gradient overlay -->
                        <div style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            height: 4px;
                            background: linear-gradient(90deg, #10b981, #059669);
                        "></div>
                        
                        <div style="
                            display: flex;
                            align-items: center;
                            margin-bottom: 1.5rem;
                        ">
                            <div style="
                                width: 4rem;
                                height: 4rem;
                                background: linear-gradient(135deg, #10b981, #059669);
                                border-radius: 16px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin-right: 1rem;
                                box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
                            ">
                                <svg style="width: 1.75rem; height: 1.75rem; color: white;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.623 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                            </div>
                            <h4 style="
                                font-size: 1.5rem;
                                font-weight: 700;
                                color: #1f2937;
                                margin: 0;
                            ">{{ __('welcome.security_title') }}</h4>
                        </div>
                        
                        <p style="
                            color: #6b7280;
                            margin-bottom: 1.5rem;
                            line-height: 1.7;
                            font-size: 1.1rem;
                        ">{{ __('welcome.security_description') }}</p>
                        
                        <div style="
                            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
                            border-left: 4px solid #10b981;
                            border-radius: 12px;
                            padding: 1.5rem;
                            position: relative;
                        ">
                            <div style="
                                position: absolute;
                                top: 12px;
                                right: 12px;
                                width: 24px;
                                height: 24px;
                                background: #10b981;
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                            ">
                                <svg style="width: 14px; height: 14px; color: white;" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p style="
                                color: #065f46;
                                margin: 0;
                                line-height: 1.6;
                                font-weight: 500;
                                padding-right: 2rem;
                            ">{{ __('welcome.security_commitment') }}</p>
                        </div>
                    </div>

                                         <!-- Expertise Card -->
                    <div class="about-card card-hover glass-effect" style="
                        background: rgba(255, 255, 255, 0.95);
                        border-radius: 24px;
                        padding: 2.5rem;
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
                        border: 1px solid rgba(255, 255, 255, 0.2);
                        position: relative;
                        overflow: hidden;
                    ">
                        <!-- Gradient overlay -->
                        <div style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            height: 4px;
                            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
                        "></div>
                        
                        <div style="
                            display: flex;
                            align-items: center;
                            margin-bottom: 1.5rem;
                        ">
                            <div style="
                                width: 4rem;
                                height: 4rem;
                                background: linear-gradient(135deg, #3b82f6, #1d4ed8);
                                border-radius: 16px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                margin-right: 1rem;
                                box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
                            ">
                                <svg style="width: 1.75rem; height: 1.75rem; color: white;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                                </svg>
                            </div>
                            <h4 style="
                                font-size: 1.5rem;
                                font-weight: 700;
                                color: #1f2937;
                                margin: 0;
                            ">{{ __('welcome.reliability_title') }}</h4>
                        </div>
                        
                        <div style="
                            background: linear-gradient(135deg, #eff6ff, #dbeafe);
                            border-radius: 16px;
                            padding: 2rem;
                            border: 1px solid #93c5fd;
                            position: relative;
                        ">
                            <div style="
                                position: absolute;
                                top: -10px;
                                right: 20px;
                                background: #3b82f6;
                                color: white;
                                padding: 0.5rem 1rem;
                                border-radius: 20px;
                                font-size: 0.85rem;
                                font-weight: 600;
                                box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
                            ">✨ Expert Certifié</div>
                            <p style="
                                color: #1e40af;
                                margin: 0;
                                line-height: 1.7;
                                font-size: 1.1rem;
                                font-weight: 500;
                            ">{{ __('welcome.reliability_description') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-24 sm:py-32">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <div class="mx-auto max-w-2xl lg:text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-600">{{ __('welcome.features_subtitle') }}</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ __('welcome.features_title') }}</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">{{ __('welcome.features_description') }}</p>
                </div>
                <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
                    <dl class="grid grid-cols-1 gap-x-8 gap-y-10 max-w-xl lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="flex absolute top-0 left-0 justify-center items-center w-10 h-10 bg-blue-600 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l-3 3m3-3l3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.33-2.33 3 3 0 013.75 5.25" />
                                    </svg>
                                </div>
                                {{ __('welcome.feature_upload_title') }}
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">{{ __('welcome.feature_upload_desc') }}</dd>
                        </div>
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="flex absolute top-0 left-0 justify-center items-center w-10 h-10 bg-blue-600 rounded-lg">
                                     <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                                    </svg>
                                </div>
                                {{ __('welcome.feature_ai_title') }}
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">{{ __('welcome.feature_ai_desc') }}</dd>
                        </div>
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="flex absolute top-0 left-0 justify-center items-center w-10 h-10 bg-blue-600 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 100 15 7.5 7.5 0 000-15z" /><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197" />
                                    </svg>
                                </div>
                                {{ __('welcome.feature_security_title') }}
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">{{ __('welcome.feature_security_desc') }}</dd>
                        </div>
                        <div class="relative pl-16">
                            <dt class="text-base font-semibold leading-7 text-gray-900">
                                <div class="flex absolute top-0 left-0 justify-center items-center w-10 h-10 bg-blue-600 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </div>
                                {{ __('welcome.feature_admin_title') }}
                            </dt>
                            <dd class="mt-2 text-base leading-7 text-gray-600">{{ __('welcome.feature_admin_desc') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        @php
        $packsData = [
            'packs' => [
                ['name' => __('welcome.pack_essential_name'), 'subtitle' => __('welcome.pack_essential_subtitle'), 'icon' => '', 'description' => __('welcome.pack_essential_desc'), 'highlight' => false, 'cta' => __('welcome.pack_essential_cta')],
                ['name' => __('welcome.pack_protocol_name'), 'subtitle' => __('welcome.pack_protocol_subtitle'), 'icon' => '', 'description' => __('welcome.pack_protocol_desc'), 'highlight' => false, 'cta' => __('welcome.pack_protocol_cta')],
                ['name' => __('welcome.pack_methodo_name'), 'subtitle' => __('welcome.pack_methodo_subtitle'), 'icon' => '', 'description' => __('welcome.pack_methodo_desc'), 'highlight' => true, 'cta' => __('welcome.pack_methodo_cta')],
                ['name' => __('welcome.pack_expert_name'), 'subtitle' => __('welcome.pack_expert_subtitle'), 'icon' => '', 'description' => __('welcome.pack_expert_desc'), 'highlight' => false, 'cta' => __('welcome.pack_expert_cta')],
            ],
            'features' => [
                __('welcome.feature_protocol') => [false, true, true, true],
                __('welcome.feature_descriptive') => [true, true, true, true],
                __('welcome.feature_ttest') => [true, false, true, true],
                __('welcome.feature_chi2') => [true, false, true, true],
                __('welcome.feature_anova') => [true, false, true, true],
                __('welcome.feature_multivariate') => [false, false, false, true],
                __('welcome.feature_survival') => [false, false, false, true],
                __('welcome.feature_roc') => [false, false, false, true],
                __('welcome.feature_visualization') => [true, true, true, true],
                __('welcome.feature_sample_size') => [true, true, true, true],
                __('welcome.feature_accompaniment') => [false, false, 'Protocole uniquement', 'Complet jusqu\'à publication'],
                __('welcome.feature_meetings') => [false, true, 'À la demande', 'Réunions régulières'],
            ]
        ];
        @endphp
        <section id="pricing" class="py-24 bg-gray-900 sm:py-32">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-400">{{ __('welcome.pricing_subtitle') }}</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ __('welcome.pricing_title') }}</p>
                    <p class="mt-6 text-lg leading-8 text-gray-300">{{ __('welcome.pricing_description') }}</p>
                </div>
                <div class="grid isolate grid-cols-1 gap-8 mx-auto mt-16 max-w-md md:max-w-2xl md:grid-cols-2 lg:max-w-none lg:grid-cols-4">
                    @foreach($packsData['packs'] as $index => $pack)
                        <div class="rounded-3xl p-8 ring-1 xl:p-10 {{ $pack['highlight'] ? 'bg-white/5 ring-2 ring-blue-500' : 'ring-white/10' }}">
                            <h3 class="text-lg font-semibold leading-8 text-white">{{ $pack['name'] }}@if(!empty($pack['icon'])) <span class="text-2xl">{{ $pack['icon'] }}</span>@endif</h3>
                            <p class="mt-4 text-sm leading-6 text-gray-300">{{ $pack['description'] }}</p>
                            <a href="{{ route('register', ['pack' => $pack['name']]) }}" class="mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 {{ $pack['highlight'] ? 'bg-blue-600 text-white shadow-sm hover:bg-blue-500 focus-visible:outline-blue-600' : 'bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white' }}">{{ $pack['cta'] }}</a>
                            <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300 xl:mt-10">
                                @foreach($packsData['features'] as $featureName => $availability)
                                    <li class="flex gap-x-3">
                                        @if($availability[$index] === true)
                                            <svg class="flex-none w-5 h-6 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-white">{{ $featureName }}</span>
                                        @elseif($availability[$index] === false)
                                            <svg class="flex-none w-5 h-6 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                            </svg>
                                            <span class="text-gray-400">{{ $featureName }}</span>
                                        @else
                                            <svg class="flex-none w-5 h-6 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a.75.75 0 000 1.5h.253a.25.25 0 01.244.304l-.459 2.066A1.75 1.75 0 0010.747 15H11a.75.75 0 000-1.5h-.253a.25.25 0 01-.244-.304l.459-2.066A1.75 1.75 0 009.253 9H9z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="text-white">{{ $featureName }} <span class="text-gray-400">({{ $availability[$index] }})</span></span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Services à la carte Section -->
        <section id="contact" class="py-24 bg-gray-50 sm:py-32">
            <div class="px-6 mx-auto max-w-7xl lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-base font-semibold leading-7 text-blue-600">Services personnalisés</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Services à la carte :</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Sélectionnez les services dont vous avez besoin et obtenez un devis personnalisé</p>
                </div>

                <div class="grid grid-cols-1 gap-x-8 gap-y-10 mx-auto mt-16 max-w-xl lg:max-w-6xl lg:grid-cols-2">
                    <!-- Formulaire services à la carte -->
                    <div>
                        <h3 class="mb-6 text-lg font-semibold leading-7 text-gray-900">Sélectionnez vos services</h3>
                        
                        <form id="services-form" class="space-y-6">
                            <!-- Services disponibles avec cases à cocher -->
                            <div class="space-y-4">
                                <h4 class="mb-4 font-medium text-gray-900 text-md">Services disponibles :</h4>
                                
                                <div class="grid grid-cols-1 gap-3">
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Calcul de la taille échantillonnale" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Calcul de la taille échantillonnale</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Etablissement d'un plan d'analyses statistiques" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Établissement d'un plan d'analyses statistiques</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Nettoyage + organisation des données" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Nettoyage + organisation des données</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Visualisation des données (graphique + interprétation)" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Visualisation des données (graphique + interprétation)</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Analyse descriptive" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Analyse descriptive</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Analyses bivariées : Test t / Chi² / ANOVA / corrélations" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Analyses bivariées : Test t / Chi² / ANOVA / corrélations</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Courbe ROC et validité d'un test diagnostique" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Courbe ROC et validité d'un test diagnostique</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Analyse de survie / Kaplan-Meier" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Analyse de survie / Kaplan-Meier</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Analyse multivariée (ACP, ACM, AFC...)" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Analyse multivariée (ACP, ACM, AFC...)</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Régressions : linéaires multiples / logistiques" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Régressions : linéaires multiples / logistiques</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Modèle de Cox" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Modèle de Cox</span>
                                    </label>
                                    
                                    <label class="flex items-start p-3 space-x-3 rounded-lg border border-gray-200 cursor-pointer hover:bg-blue-50">
                                        <input type="checkbox" name="services[]" value="Élaboration de protocole" class="mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        <span class="text-sm text-gray-700">Élaboration de protocole</span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Informations du projet -->
                    <div class="lg:pl-8">
                        <h3 class="mb-6 text-lg font-semibold leading-7 text-gray-900">Informations sur votre projet</h3>
                        
                        <div class="space-y-6">
                            <!-- Nombre d'individus total (optionnel) -->
                            <div>
                                <label for="nb_individus" class="block mb-2 text-sm font-medium text-gray-900">
                                    Nombre d'individus total 
                                    <span class="text-xs text-gray-500">(optionnel)</span>
                                </label>
                                <input type="number" 
                                       id="nb_individus" 
                                       name="nb_individus" 
                                       placeholder="Ex: 100"
                                       class="block px-3.5 py-2 w-full text-gray-900 rounded-md border-0 ring-1 ring-inset ring-gray-300 shadow-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                            </div>

                            <!-- Nombre de variables (obligatoire) -->
                            <div>
                                <label for="nb_variables" class="block mb-2 text-sm font-medium text-gray-900">
                                    Nombre de variables 
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       id="nb_variables" 
                                       name="nb_variables" 
                                       required
                                       placeholder="Ex: 15"
                                       class="block px-3.5 py-2 w-full text-gray-900 rounded-md border-0 ring-1 ring-inset ring-gray-300 shadow-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                            </div>

                            <!-- Délais de réalisation (obligatoire) -->
                            <div>
                                <label for="delais" class="block mb-2 text-sm font-medium text-gray-900">
                                    Délais de réalisation 
                                    <span class="text-red-500">*</span>
                                </label>
                                <select id="delais" 
                                        name="delais" 
                                        required
                                        class="block px-3.5 py-2 w-full text-gray-900 rounded-md border-0 ring-1 ring-inset ring-gray-300 shadow-sm focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <option value="">Sélectionnez un délai</option>
                                    <option value="1-7 jours">1-7 jours</option>
                                    <option value="1-2 semaines">1-2 semaines</option>
                                    <option value="2-4 semaines">2-4 semaines</option>
                                    <option value="1-2 mois">1-2 mois</option>
                                    <option value="Plus de 2 mois">Plus de 2 mois</option>
                                </select>
                            </div>

                            <!-- Remarques -->
                            <div>
                                <label for="remarques" class="block mb-2 text-sm font-medium text-gray-900">
                                    Remarques
                                </label>
                                <textarea id="remarques" 
                                          name="remarques" 
                                          rows="4"
                                          placeholder="Ajoutez ici toute information complémentaire..."
                                          class="block px-3.5 py-2 w-full text-gray-900 rounded-md border-0 ring-1 ring-inset ring-gray-300 shadow-sm placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6"></textarea>
                            </div>

                            <!-- Bouton Obtenir un devis -->
                            <div class="mt-8">
                                <button type="button" 
                                        id="obtenir-devis-btn"
                                        onclick="obtenirDevis()"
                                        class="flex justify-center items-center px-3.5 py-3 w-full text-sm font-semibold text-center text-white bg-blue-600 rounded-md shadow-sm transition-colors hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Obtenir un devis
                                </button>
                            </div>

                            <p class="text-xs text-center text-gray-500">
                                <span class="text-red-500">*</span> Champs obligatoires
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-white bg-gray-900" aria-labelledby="footer-heading">
            <h2 id="footer-heading" class="sr-only">Footer</h2>
            <div class="px-6 pt-16 pb-8 mx-auto max-w-7xl sm:pt-24 lg:px-8 lg:pt-32">
                <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="space-y-8">
                        <div class="flex items-center">
                            <x-application-logo class="block w-auto h-8 text-white fill-current"/>
                            <span class="ml-3 text-xl font-bold text-white">{{ config('app.name', 'AIStats') }}</span>
                        </div>
                        <p class="text-sm leading-6 text-gray-300">
                            {{ __('welcome.footer_description') }}
                        </p>
                        <div class="flex space-x-6">
                            <a href="https://www.facebook.com/profile.php?id=61575124859967" target="_blank" class="text-gray-400 hover:text-gray-300">
                                <span class="sr-only">Facebook</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/aistat2025" target="_blank" class="text-gray-400 hover:text-gray-300">
                                <span class="sr-only">Instagram</span>
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.316-1.296C4.343 14.928 3.9 13.9 3.9 12.76c0-1.297.49-2.448 1.296-3.316.764-.764 1.792-1.207 2.932-1.207 1.297 0 2.448.49 3.316 1.296.764.764 1.207 1.792 1.207 2.932 0 1.297-.49 2.448-1.296 3.316-.764.764-1.792 1.207-2.932 1.207zm7.718-9.038h-1.404V6.547h1.404v1.403zm-2.878 5.864c-.764-.764-1.792-1.207-2.932-1.207-1.297 0-2.448.49-3.316 1.296-.764.764-1.207 1.792-1.207 2.932 0 1.297.49 2.448 1.296 3.316.764.764 1.792 1.207 2.932 1.207 1.297 0 2.448-.49 3.316-1.296.764-.764 1.207-1.792 1.207-2.932 0-1.297-.49-2.448-1.296-3.316z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-8 mt-16 xl:col-span-2 xl:mt-0">
                        <div class="md:grid md:grid-cols-2 md:gap-8">
                            <div>
                                <h3 class="text-sm font-semibold leading-6 text-white">{{ __('welcome.footer_services') }}</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li><a href="#features" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('welcome.footer_analysis') }}</a></li>
                                    <li><a href="#pricing" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('welcome.footer_packs') }}</a></li>
                                    <li><a href="#contact" class="text-sm leading-6 text-gray-300 hover:text-white">{{ __('welcome.footer_contact') }}</a></li>
                                </ul>
                            </div>
                            <div class="mt-10 md:mt-0">
                                <h3 class="text-sm font-semibold leading-6 text-white">{{ __('welcome.footer_contact') }}</h3>
                                <ul role="list" class="mt-6 space-y-4">
                                    <li class="text-sm leading-6 text-gray-300">📧 Aistat2025@gmail.com</li>
                                    <li class="text-sm leading-6 text-gray-300">📞 0799963843</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-8 mt-16 border-t border-white/10 sm:mt-20 lg:mt-24">
                    <p class="text-xs leading-5 text-gray-400">&copy; {{ date('Y') }} {{ config('app.name', 'AIStats') }}. {{ __('welcome.footer_rights') }}</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
