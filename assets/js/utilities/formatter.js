export const truncateText = (text) => {
    const truncatedText = text.slice(0, 10);

    return `
        <span
            class="tool-tip" 
            style="cursor: pointer"
            data-fulltext="${text}"
            data-bs-toggle="tooltip" 
            data-bs-placement="right" 
            title="${text}"
        >
            ${truncatedText}<span class="no-select">...</span>
        </span>
    `;
}

export const formatAsAmount = (number) => {
    const num = parseInt(number);
    const formatted = new Intl.NumberFormat('en-US', {
        style: 'decimal',
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }).format(num);

    return `<i class="fas fa-peso-sign"></i> <span style="margin-left: 10px">${formatted}</span>`;
}

export const dateFormatter = (d) => {
    const date = new Date(d)
    return date.toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    })
}

export const timestampFormatter = (d) => {
    const date = new Date(d);
    return date.toLocaleString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "numeric",
        minute: "2-digit",
        hour12: true,
    });
};
