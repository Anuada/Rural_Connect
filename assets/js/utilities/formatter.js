import fetch from "./fetchClient.js";

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

export const truncateSentence = (sentence, limit = 70) => {
    if (sentence.length <= limit) return sentence;

    let truncated = sentence.substring(0, limit);
    const lastSpace = truncated.lastIndexOf(' ');

    if (lastSpace !== -1) {
        truncated = truncated.substring(0, lastSpace);
    }

    return `${truncated}...`;
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

export const capitalizeFirstLetter = (str) => {
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

export const ucwords = (str) => {
    return str
        .toLowerCase()
        .replace(/\b\w/g, char => char.toUpperCase());
}

export const urlEncode = (str) => encodeURIComponent(str).replace(/%20/g, '+');

export const displayFormattedDeliveryCondition = (delivery_condition) => {
    switch (delivery_condition) {
        case 'good':
            return "Received in good condition";

        case 'damaged':
            return "Received, but items were damaged";

        case 'missing items':
            return "Received, but some items are missing";

        default:
            return "Received";
    }
}

export const pluralize = async (word) => {
    return await handleFetchPluralForm(word);
}

const handleFetchPluralForm = async (word) => {
    try {
        const response = await fetch.get(`../api/pluralize.word.php?word=${word}`);
        const { data } = response?.data;
        return data;
    } catch (error) {
        return error;
    }
}