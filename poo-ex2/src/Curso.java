import java.util.ArrayList;
import java.util.List;

public class Curso {
    private String nome;
    private List<String> materias = new ArrayList<>();

    public Curso(String nome) {
        this.nome = nome;
    }

    public Curso(String nome, List<String> materias) {
        this.nome = nome;
        this.materias = materias;
    }

    public String getNome() {
        return nome;
    }

    public List<String> getMaterias() {
        return materias;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public void addMateria(String materia) {
        this.materias.add(materia);
    }
}
