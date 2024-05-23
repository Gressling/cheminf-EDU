import json
import pandas as pd
from pathlib import Path
import matplotlib.pyplot as plt


def create_directory(directory: Path) -> None:
    print(f"Directory -{directory}- does not exist. Creating it...")
    directory.mkdir(parents=True, exist_ok=True)


def create_data_file(file_path: Path) -> None:
    print(f"Data file -{file_path}- does not exist. Creating it...")
    file_path.touch()


def handle_paths(directory: Path, file_path: Path) -> None:
    """Checks if data directory and data file are existing and creates them if not."""
    if not directory.exists():
        create_directory(directory=directory)
    if not file_path.exists():
        create_data_file(file_path=file_path)


def check_data_file_empty(file_path: Path) -> bool:
    """Checks if data file is empty.

    @param file_path: data file path.
    @return bool: True, if file is empty, False otherwise.
    """
    if file_path.exists():
        with file_path.open("r") as f:
            return f.read().strip() == ""


def load_data_csv(path: str) -> pd.DataFrame:
    return pd.read_csv(path)


def convert_to_csv(data: list, output_path: str) -> None:
    try:
        df = pd.DataFrame(data)
        df.to_csv(output_path, index=False)
    except Exception as e:
        print(f"Could not convert to CSV: {e}")


def save_results(history, metrics, use_cv, hyperparameters, results_dir="results"):
    results_dir = Path(results_dir)
    results_dir.mkdir(exist_ok=True)

    run_number = 1
    while (results_dir / f"{run_number:04d}").exists():
        run_number += 1
    run_subdir = results_dir / f"{run_number:04d}"
    run_subdir.mkdir()

    results = {
        "accuracy": metrics[1],
        "loss": metrics[0],
        "cv_used": use_cv,
        "hyperparameters": hyperparameters,
    }

    with open(run_subdir / "results.json", "w") as f:
        json.dump(results, f, indent=4)

    # Plot training history and save the plot
    fig, ax1 = plt.subplots(figsize=(12, 5))

    # Plot training and validation loss with orange color
    ax1.plot(history.history["loss"], label="Train Loss", color="orange")
    if "val_loss" in history.history:
        ax1.plot(
            history.history["val_loss"],
            label="Validation Loss",
            color="orange",
            linestyle="--",
        )
    ax1.set_xlabel("Epoch")
    ax1.set_ylabel("Loss")
    ax1.legend(loc="center left", bbox_to_anchor=(1, 0.5))

    # Plot training and validation accuracy
    ax2 = ax1.twinx()
    ax2.plot(history.history["accuracy"], label="Train Accuracy")
    if "val_accuracy" in history.history:
        ax2.plot(
            history.history["val_accuracy"], label="Validation Accuracy", linestyle="--"
        )
    ax2.set_ylabel("Accuracy")
    ax2.legend(loc="center left", bbox_to_anchor=(1, 0.6))

    fig.tight_layout()
    plt.title("Model Training History")
    plt.savefig(run_subdir / "training_history.png")
    plt.close()
