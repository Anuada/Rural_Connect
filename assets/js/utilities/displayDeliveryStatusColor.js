const displayDeliveryStatus = (status) => {
    switch (status) {
        case "To Deliver":
            return `<span class="text-info user-select-none">${status}</span>`;
    
        case "In Transit":
            return `<span class="text-primary user-select-none">${status}</span>`;
    
        case "Failed Delivery":
            return `<span class="text-danger user-select-none">${status}</span>`;
    
        case "Returned":
            return `<span class="text-warning user-select-none">${status}</span>`;
    
        case "Delivered":
            return `<span class="text-success user-select-none">${status}</span>`;

        case "Claimed":
            return `<span class="text-teal user-select-none">${status}</span>`;
    
        default:
            break;
    }
};

export default displayDeliveryStatus;