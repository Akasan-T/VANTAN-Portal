// QRコード読み取り
import styles from "./QRScanner.module.css";
import { useEffect, useRef, useState } from "react";
import { BrowserMultiFormatReader } from "@zxing/browser";

function QRScanner({ onScan }) {
    const videoRef = useRef(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        const codeReader = new BrowserMultiFormatReader();
        let stopped = false;

        const startScanner = async () => {
            try {
                // null = デフォルトカメラ
                await codeReader.decodeFromVideoDevice(
                    null,
                    videoRef.current,
                    (result, err) => {
                        if (stopped) return;

                        if (result) {
                            stopped = true;
                            onScan(result.getText());
                            // カメラ停止
                            if (videoRef.current?.srcObject) {
                                videoRef.current.srcObject.getTracks().forEach(track => track.stop());
                            }
                        }

                        // NotFoundException は無視
                    }
                );

                // video.play() の Promise をキャッチして AbortError を無視
                if (videoRef.current) {
                    const playPromise = videoRef.current.play();
                    if (playPromise !== undefined) {
                        playPromise.catch((e) => {
                        if (e.name !== "AbortError") console.error(e);
                        });
                    }
                }
            } catch (err) {
                setError(err.message);
            }
        };

        startScanner();

        return () => {
            stopped = true;
            if (videoRef.current?.srcObject) {
                videoRef.current.srcObject.getTracks().forEach(track => track.stop());
            }
        };
    }, [onScan]);

    return (
        <div className={styles.content}>
            {error && <p>{error}</p>}
            <video ref={videoRef} styles={styles.video}></video>
        </div>
    )
}

export default QRScanner;