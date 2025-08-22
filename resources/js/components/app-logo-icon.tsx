import { HTMLAttributes } from 'react';

export default function AppLogoIcon(props: HTMLAttributes<HTMLDivElement>) {
    const { className, ...rest } = props;
    return (
        <div className={`text-lg font-bold ${className || ''}`} style={{ lineHeight: '1' }} {...rest}>🏫</div>
    );
}