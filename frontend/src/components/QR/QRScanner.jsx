// QRコード読み取り
import styles from "./QRScanner.module.css";
import { useEffect, useRef, useState } from "react";
import { BrowserMultiFormatReader, BrowserCodeReader } from "@zxing/browser";

function QRScanner({ onScan }) {
    const videoRef = useRef(null);
    const codeReaderRef = useRef(null);
    const [error, setError] = useState(null);

    useEffect(() => {
        const codeReader = new BrowserMultiFormatReader();
        codeReaderRef.current = codeReader;

        let stopped = false

        const startScanner = async () => {
            try {
                //（staticメソッド）
                const devices = await BrowserCodeReader.listVideoInputDevices();

                if (!devices.length) {
                    setError("カメラが見つかりません");
                    return;
                }

                // 外付け優先
                const externalCamera = devices.find((d) => 
                    d.label.match(/usb|external|logitech/i)
                );

                const deviceId = externalCamera
                    ? externalCamera.deviceId
                    : devices[0].deviceId; // なければ最初のカメラ

                await codeReader.decodeFromVideoDevice(
                    deviceId,
                    videoRef.current,
                    (result) => {
                        if (stopped) return;

                        if (result) {
                            stopped = true
                            onScan(result.getText());

                            stopCamera();
                        }

                        // NotFoundExceptionは無視（毎フレーム出るため）
                    }
                );
            } catch (err) {
                console.error(err);
                setError("カメラ起動に失敗しました");
            }
        };

        const stopCamera = () => {
            stopped = true;

            if (videoRef.current?.srcObject) {
                videoRef.current.srcObject
                    .getTracks()
                    .forEach((track) => track.stop());
                
                videoRef.current.srcObject = null
            }
        };

        startScanner();

        return () => {
            stopCamera();
        };
    }, [onScan]);

    return (
        <div className={styles.wrapper}>
            {error && <p>{error}</p>}
            <video ref={videoRef} className={styles.video}></video>

            {/* ガイド枠 */}
            <div className={styles.overlay}>
                <div className={styles.frame} />
            </div>
        </div>
    )
}

export default QRScanner;