<style>
/* Custom Switch Styles */
.form-check-input[type="checkbox"] {
    width: 3rem !important;
    height: 1.5rem !important;
    border-radius: 1rem !important;
    background-color: #e9ecef !important;
    border: 2px solid #e9ecef !important;
    position: relative !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    background-image: none !important;
}

.form-check-input[type="checkbox"]:before {
    content: '' !important;
    position: absolute !important;
    width: 1.25rem !important;
    height: 1.25rem !important;
    border-radius: 50% !important;
    background-color: #ffffff !important;
    top: 50% !important;
    left: 0.125rem !important;
    transform: translateY(-50%) !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
}

.form-check-input[type="checkbox"]:checked {
    background-color: #BA1C7B !important;
    border-color: #BA1C7B !important;
    background-image: none !important;
}

.form-check-input[type="checkbox"]:checked:before {
    left: calc(100% - 1.25rem - 0.125rem) !important;
    background-color: #ffffff !important;
}

.form-check-input[type="checkbox"]:focus {
    box-shadow: 0 0 0 0.25rem rgba(186, 28, 123, 0.25) !important;
    outline: none !important;
}

.form-check-input[type="checkbox"]:hover {
    border-color: #BA1C7B !important;
}

/* Status switch specific styling */
#team_status_switch {
    width: 3rem !important;
    height: 1.5rem !important;
    border-radius: 1rem !important;
    background-color: #e9ecef !important;
    border: 2px solid #e9ecef !important;
    position: relative !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    background-image: none !important;
}

#team_status_switch:before {
    content: '' !important;
    position: absolute !important;
    width: 1.25rem !important;
    height: 1.25rem !important;
    border-radius: 50% !important;
    background-color: #ffffff !important;
    top: 50% !important;
    left: 0.125rem !important;
    transform: translateY(-50%) !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) !important;
}

#team_status_switch:checked {
    background-color: #BA1C7B !important;
    border-color: #BA1C7B !important;
    background-image: none !important;
}

#team_status_switch:checked:before {
    left: calc(100% - 1.25rem - 0.125rem) !important;
    background-color: #ffffff !important;
}

#team_status_switch:focus {
    box-shadow: 0 0 0 0.25rem rgba(186, 28, 123, 0.25) !important;
    outline: none !important;
}

#team_status_switch:hover {
    border-color: #BA1C7B !important;
}

/* Remove only checkmark icons from background, keep the sliding ball */
.form-check-input[type="checkbox"]:checked::after,
#team_status_switch:checked::after {
    content: none !important;
    background-image: none !important;
}

/* Keep the sliding ball (::before pseudo-element) */
.form-check-input[type="checkbox"]:checked::before,
#team_status_switch:checked::before {
    content: '' !important;
    background-image: none !important;
}
</style>
