#!/bin/bash

# Create directories
mkdir -p public/plugins/{font-awesome/css,jquery,toastr,select2/{css,js},sweetalert2}

# Download and place files
# Note: You'll need to replace these URLs with the correct versions you want to use
curl -o public/plugins/font-awesome/css/all.min.css "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
curl -o public/plugins/jquery/jquery.min.js "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
curl -o public/plugins/sweetalert2/sweetalert2.min.js "https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"
curl -o public/plugins/toastr/toastr.min.css "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
curl -o public/plugins/toastr/toastr.min.js "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
curl -o public/plugins/select2/css/select2.min.css "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
curl -o public/plugins/select2/js/select2.min.js "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" 