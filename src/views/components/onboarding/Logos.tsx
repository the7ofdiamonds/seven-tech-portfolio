import React, { useState, useEffect } from 'react'

import { EditGallery, Gallery } from '@the7ofdiamonds/github-portfolio';

import { ProjectOnboarding } from '@the7ofdiamonds/github-portfolio';

import styles from './Logos.module.scss';

interface LogosProps {
    projectOnboarding: ProjectOnboarding;
    setVal: (value: ProjectOnboarding) => void;
}

const Logos: React.FC<LogosProps> = ({ projectOnboarding, setVal }) => {
    const [gallery, setGallery] = useState<Gallery>(projectOnboarding.images ?? new Gallery);

    useEffect(() => {
        projectOnboarding.setImages(gallery)
        setVal(projectOnboarding)
    }, [gallery]);

    return (
        <tr>
            <label htmlFor="logos">
                Does (your company or organization) have a logo? If Yes,
                provide a link to it below.
            </label>
            <EditGallery location={''} gallery={gallery} setVal={setGallery} />
        </tr>
    )
}

export default Logos