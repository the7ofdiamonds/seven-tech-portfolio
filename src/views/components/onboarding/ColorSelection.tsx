import React, { useState, useEffect } from 'react'

import { EditColorsList } from '@the7ofdiamonds/github-portfolio';

import { Colors, ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

interface ColorsProps {
    projectOnboarding: ProjectOnboarding | null;
    setVal: (value: ProjectOnboarding) => void;
}

const ColorSelection: React.FC<ColorsProps> = ({ projectOnboarding, setVal }) => {
    const [onboarding, setOnboarding] = useState<ProjectOnboarding>(projectOnboarding ?? new ProjectOnboarding);
    const [colors, setColors] = useState<Colors>(
        onboarding.colors ? new Colors(Array.from(onboarding.colors)) : new Colors
    );

    useEffect(() => {
        if (projectOnboarding) {
            setOnboarding(projectOnboarding)
        }
    }, [projectOnboarding]);

    useEffect(() => {
        if (projectOnboarding?.colors) {
            setColors(new Colors(Array.from(projectOnboarding.colors)))
        }
    }, [projectOnboarding?.colors]);

    useEffect(() => {
        onboarding.setColors(colors.list)
        setVal(onboarding)
    }, [colors.list]);

    return (
        <tr>
            <label htmlFor="colors">
                Does (your company or organization) have colors? If Yes,
                provide them below.
            </label>
            <EditColorsList colors={colors} setVal={setColors} />
        </tr>
    )
}

export default ColorSelection