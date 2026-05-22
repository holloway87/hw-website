import { marked } from 'marked';
const renderer = {
    code({ lang, text }) {
        return `<pre class="mb-4 px-2 py-1.5 border-2 rounded-md border-dashed border-white/50 overflow-x-scroll contain-inline-size"><code data-language="${lang}">${text}</code></pre>`;
    },
    heading({ tokens, depth }) {
        const text = this.parser.parseInline(tokens);

        return `<h${depth} class="mb-4">
            ${text}
        </h${depth}>`;
    },
    link({ tokens, href }) {
        const text = this.parser.parseInline(tokens);

        return `<a href="${href}" class="underline decoration-dashed underline-offset-4 hover:no-underline">${text}</a>`;
    },
    paragraph({ tokens }) {
        const text = this.parser.parseInline(tokens);

        return `<p class="mb-4">
            ${text}
        </p>`;
    },
};
marked.use({ renderer });

export default marked;
