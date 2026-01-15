import { reactive } from 'vue';

interface BreadcrumbItem {
    label: string;
    href?: string;
}

interface HeaderState {
    title: string;
    subtitle: string;
    breadcrumbs: BreadcrumbItem[];
}

const state = reactive<HeaderState>({
    title: '',
    subtitle: '',
    breadcrumbs: [],
});

export function useHeader() {
    function setHeader(config: Partial<HeaderState>) {
        state.title = config.title ?? '';
        state.subtitle = config.subtitle ?? '';
        state.breadcrumbs = config.breadcrumbs ?? [];
    }

    return {
        state,
        setHeader,
    };
}
